<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $cartCollection = Cart::getContent();

        /* Set meta */
        $metaTitle = 'Giỏ hàng - Chungauto.vn';
        $metaDescription = 'Nội thất Ô tô | chungauto.vn chuyên cung cấp dịch vụ Phân phối sản phẩm mới - thu mua sản phẩm cũ
        và sửa chữa toàn bộ sản phẩm DVD - CD ô tô tất cả các thương hiệu như: Mazda, Ford Fiesta, hyundai, honda...';
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('description', $metaDescription)
            ->set('og:description', $metaDescription)
            ->set('canonical', route('fe.cart'));

            meta()->set('robots', 'noindex');

        /* Hết Set meta */

        return view('front_end.carts.index', compact('cartCollection'));
    }

    public function destroy(Request $request)
    {
        $productId = $request->get('id');
        return Cart::remove($productId);
    }

    public function update(Request $request)
    {
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $item = Cart::get($productId);
        if ($item) {
            Cart::update($productId, [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity,
                ],
            ]);
        }
        $cartCollection = Cart::getContent();
        return view('front_end.carts.elements.product', compact('cartCollection'));
    }

    public function addItemToCart(Request $request)
    {
        $productId = $request->get('productId');
        $countItem = $request->get('countItem');
        $product = Product::findOrFail($productId);

        $item = Cart::get($productId);
        $countItem = !empty($countItem)?$countItem:1;
        if ($item) {
            if(!empty($request->get('countItem'))){
                Cart::update($product->id, [
                    'quantity' =>$countItem,
                ]);
            }else{
                Cart::update($product->id, [
                    'quantity' => +1,
                ]);
            }
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->getRealPriceAttribute(),
                'quantity' => $countItem,
                'attributes' => [
                    "picture" => (!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, '') : asset(config('admin.image_not_found')),
                ],
                'associatedModel' => Product::class,
            ]);
        }

        return Cart::getTotalQuantity();
    }

    public function save(Checkout $request)
    {
        $data = $request->validated();

        $getData = static::calculatorPaymentPrice($data = $request->validated());

        $totalPrice = $getData['total_price'];
        $paymentPrice = $getData['payment_price'];
        $orderProducts = $getData['order_products'];

        $order = Order::create(array_merge($data, [
            'order_id' => date('YmdHis') . random_int(100, 999),
            'status' => array_search('New', Order::$ORDERSTATUS),
            'total_price' => $totalPrice,
            'total_payment_price' => $paymentPrice,
            'bundle_saving' => $getData['bundle_savings'],
        ]));

        $address = $order->address()->create($data['address']);
        $order->orderProducts()->createMany($orderProducts);

        if ($paymentPrice > 0 && $data['payment_method'] === 'alepay') {
            try {
                $payment = Payment::driver('alepay')->purchase([
                    'order_id' => $order->order_id,
                    'amount' => $paymentPrice,
                    'description' => __('Thanh toán đơn hàng: :order', ['order' => $order->order_id]),
                    'quantity' => 1,
                    'callback_url' => route('cart.callback'),
                    'cancel_url' => route('cart.callback'),
                    'customer_name' => $order->customer_name,
                    'customer_email' => $order->customer_email,
                    'customer_phone' => $order->customer_mobile,
                    'customer_address' => $address->address,
                    'customer_city' => $address->province,
                    'customer_country' => $address->country,
                    'month' => $data['month'] ?? null,
                    'bank_code' => $data['bank_code'] ?? null,
                    'installment_type' => $data['installment_type'] ?? null,
                ]);

                $order->provider_order_id = $payment->getProviderOrderId();

                if ($payment->isRedirect()) {
                    $order->status = array_search('Unpaid', Order::$ORDERSTATUS);
                    $order->save();

                    return [
                        'redirect_to' => $payment->getRedirectUrl(),
                    ];
                }

                if ($payment->getStatus() == PaymentStatus::SUCCESS) {
                    $order->status = array_search('Paid', Order::$ORDERSTATUS);
                    $order->save();
                }
            } catch (Exception $e) {
                $order->status = array_search('New', Order::$ORDERSTATUS);
                $order->payment_method = 'cod';
                $order->provider_order_id = null;
                $order->save();

                Log::error('Payment error: ' . $order->order_id, [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
        }

        //Mail::to($order->customer_email)->send(new Ordered($order));
        Cart::clear();
        return redirect()
            ->route('fe.checkout', ["order_id" => $order->order_id])
            ->with('success', __('Tạo đơn hàng thành công'));
    }

    public static function calculatorPaymentPrice(array $data): array
    {
        $totalPrice = 0;
        $orderProducts = [];

        $products = Product::whereIn('id', ($productData = collect($data['products']))->pluck('id'))
            ->get()
            ->transform(function ($product) use ($productData) {
                $currentProduct = $productData->where('id', $product->id)->first();
                $product->amount = (int) $currentProduct['quantity'];

                return $product;
            });

        // Get bundles saving.
        $saving = [];
        $totalSavings = 0;

        foreach ($products as $product) {
            $warranty = null;

            if (!empty($warranty)) {
                $warrantyName = $warranty->name;

                if ($warranty->price_type == 'percent') {
                    $warranty->price = $product->price * $warranty->price / 100;
                }

                if ($product->amount > 1) {
                    $warrantyName .= ' (' . number_format($warranty->price) . 'đ / Sản phẩm)';
                }

                $warrantyPrice = $warranty->price * $product->amount;
            }

            $orderProducts[] = [
                'product_id' => $product->id,
                'customer_id' => $data['customer_id'] ?? null,
                'amount' => $product->amount,
                'price' => $product->realPrice,
                'warranty_name' => $warrantyName ?? null,
                'warranty_price' => $warrantyPrice ?? null,
                'total_price' => $totalProductPrice = $product->amount * $product->realPrice - ($saveBundle = $saving[$product->id] ?? 0) + ($warrantyPrice ?? 0),
                'note' => !empty($saveBundle) ? 'Giảm ' . number_format($saveBundle) . 'đ từ bundle.' : null,
            ];

            $totalPrice += $totalProductPrice;
        }

        $paymentPrice = $totalPrice;

        if (!empty($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->firstOrFail();
            if ($coupon->min_price <= $totalPrice) {
                $priceDiscount = 0;
                if ($coupon->type == 'percent') {
                    $priceDiscount = $totalPrice / 100 * $coupon->discount;
                } elseif ($coupon->type = 'fixed') {
                    $priceDiscount = $coupon->discount;
                }
                if ($coupon->max_discount < $priceDiscount) {
                    $priceDiscount = $coupon->max_discount;
                }
                $paymentPrice = max($totalPrice - $priceDiscount, 0);
            }
        }

        $paymentPrice -= $totalSavings;

        return [
            'total_price' => $totalPrice,
            'payment_price' => $paymentPrice,
            'order_products' => $orderProducts,
            'bundle_savings' => $totalSavings,
        ];
    }

    public function checkOut(Request $request)
    {
        $orderId = $request->get('order_id');
        $order = Order::whereOrderId($orderId)->firstOrFail();

        /* Set meta */
        $metaTitle = 'Đặt hàng thành công - Chungauto.vn';
        $metaDescription = 'Đặt hàng thành công | chungauto.vn chuyên cung cấp dịch vụ Phân phối sản phẩm mới - thu mua sản phẩm cũ
        và sửa chữa toàn bộ sản phẩm DVD - CD ô tô tất cả các thương hiệu như: Mazda, Ford Fiesta, hyundai, honda...';
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('description', $metaDescription)
            ->set('og:description', $metaDescription)
            ->set('canonical', route('fe.checkout', ["order_id" => $orderId]));
        meta()->set('robots', 'noindex');
        /* Hết Set meta */
        return view('front_end.carts.check_out', compact('order'));
    }
}
