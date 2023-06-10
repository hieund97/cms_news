<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOrder;
use App\Models\ProductTag;
use App\Models\Review;
use App\Models\Slider;
use App\Models\TextLink;
use DB;
use Illuminate\Http\Request;
use Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function show(Request $request, $slug, $id)
    {
        $data = [];

        $product = Product::with([
            'getReviewHasApproved' => function ($query) {
                $query->take(3);
            },
        ])->findOrFail($id);

        if ($product->slug != $slug) {
            return Redirect::to(route('fe.product', ["slug" => $product->slug, 'id' => $product->id]), 301);
        }
        $textLinks = TextLink::byModel(Product::class)->whereNotNull('text')->get();

        $product->description = getTextLink($product->description, $textLinks);

        $data["product"] = $product;

        $ids = array_merge($product->relates->pluck('id')
            ->toArray(), [$product->id]);

        $similarProducts = $product->similars;
        if($similarProducts->isEmpty()){
            $similarProducts = Product::filter($request->all())
                ->where('product_category_id', $product->productCategory->id)
                ->whereNotIn('id', $ids)
                ->orderByDesc('id')
                ->take(15)->get();
        }   
        $data["similarProducts"] = $similarProducts;

        // Sản phầm vừa xem
        $productListNew[$product->id] = [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'price' => $product->price,
            'real_price' => $product->getRealPriceAttribute(),
            'label_status' => $product->labelStatus(),
            'sale_percent' => $product->salePercent(),
            'is_sale' => $product->isSale(),
            'include_in_box' => $product->include_in_box,
            'productMedias' => !empty($product->productMedias[0]) ? get_image_url($product->productMedias[0]->url, '') : asset(config('admin.image_not_found')), //get_image_url($product->productMedias[0]->url, 'default'),
            'status' => $product->status,
            'status_note' => $product->status_note,
        ];

        $cookieProduct = 'recentlyProductViewed';
        $data["cookieProduct"] = $cookieProduct;
        if (isset($_COOKIE[$cookieProduct])) {
            $productList = json_decode($_COOKIE[$cookieProduct]);
            $data['recentlyViewed'] = $productList;
            foreach ($productList as $pro) {
                $productListNew[$pro->id] = [
                    'id' => $pro->id,
                    'slug' => $pro->slug,
                    'name' => $pro->name,
                    'price' => $pro->price,
                    'real_price' => $pro->real_price,
                    'label_status' => $pro->label_status,
                    'sale_percent' => $pro->sale_percent,
                    'is_sale' => $pro->is_sale,
                    'include_in_box' => $pro->include_in_box,
                    'productMedias' => $pro->productMedias,
                    'status' => $pro->status,
                    'status_note' => $pro->status_note,
                ];
            }
        
            setcookie($cookieProduct, json_encode($productListNew), time() + (86400 * 90), '/');
        } else {
            setcookie($cookieProduct, json_encode($productListNew), time() + (86400 * 90), '/');
        }

        // Hết sản phẩm vừa xem

        /* Set meta */
        $metaTitle = (!empty($product->seo->title)) ? $product->seo->title : $product->name;
        $metaDescription = strip_tags((!empty($product->seo->description)) ? $product->seo->description : $product->description);
        $metaImage = (!empty($product->seo->image)) ? $product->seo->image : ((!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, '') : asset(config('admin.image_not_found')));
        $metaKeywords = (!empty($product->seo->keyword)) ? $product->seo->keyword : '';
        $canonical = (!empty($product->seo->canonical)) ? $product->seo->canonical : route('fe.product', [
            "slug" => $product->slug,
            'id' => $product->id,
        ]);

        $robots = getMetaRobots($product->seo,1);
     
        if ($metaDescription) {
            if (mb_strlen($metaDescription, 'UTF-8') > 160) {
                $metaDescription = mb_substr(trim($metaDescription), 0, 157, 'UTF-8') . '...';
            } else {
                $metaDescription = mb_substr(trim($metaDescription), 0, 160, 'UTF-8');
            }
        }
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('description', $metaDescription)
            ->set('og:description', $metaDescription)
            ->set('og:image', $metaImage)
            ->set('canonical', $canonical);

        if ($metaKeywords) {
            meta()->set('keywords', $metaKeywords);
        }
        if ($robots) {
            meta()->set('robots', $robots);
        }
        /* Hết Set meta */
        return view('front_end.products.show', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function review(Request $request, $slug, $id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        /* Set meta */
        $metaTitle = (!empty($product->seo->title)) ? $product->seo->title : $product->name;
        $metaDescription = strip_tags((!empty($product->seo->description)) ? $product->seo->description : $product->technical_specification);
        $metaImage = (!empty($product->seo->image)) ? $product->seo->image : ((!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, '') : asset(config('admin.image_not_found')));
        $metaKeywords = (!empty($product->seo->keyword)) ? $product->seo->keyword : '';
        $canonical = (!empty($product->seo->canonical)) ? $product->seo->canonical : route('fe.product', [
            "slug" => $product->slug,
            'id' => $product->id,
        ]);
        
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('description', strip_tags($metaDescription))
            ->set('og:description', strip_tags($metaDescription))
            ->set('og:image', $metaImage)
            ->set('canonical', $canonical);
        meta()->set('robots', 'noindex,nofollow');
        $reviews = Review::where('product_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('front_end.products.review', compact('product', 'reviews'));
    }

    public function category(Request $request, $slug, $id)
    {
        $category = ProductCategory::findOrFail($id);

        if ($category->slug != $slug) {
            return Redirect::to(route('fe.product.tag', ["slug" => $category->slug, 'id' => $category->id]), 301);
        }

        $data = [];

        $data["category"] = $category;

        $data["sliders"] = Slider::where('status', true)
            ->where('model', ProductCategory::class)
            ->where('model_id', $id)
            ->orderBy('sort')
            ->orderByDesc('id')
            ->get();
        $data["banners"] = Banner::where('status', true)
            ->where('model', ProductCategory::class)
            ->where('model_id', $id)
            ->orderBy('sort')
            ->orderByDesc('id')
            ->take(2)
            ->get();

        // Tin nổi bật
        $order = ProductOrder::where('product_category_id', $id)
            ->where('type', 'category')
            ->first();
        $sortSql = 'id';

        if (!empty($order->orders)) {
            $sortSql = DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')');
        }
        $productOnTop = null;
        if (!$request->has('price') && !$request->has('sort_type')) {
            $productOnTop = Product::with('productMedias.mediaFile')
                ->whereIn('product_category_id', $category->descendants->pluck('id'))
                ->where('show_on_top', true)
                ->orderByDesc($sortSql)
                ->orderByDesc('pin_to_top')
                ->take(20)
                ->get();
        }
        $data["productOnTop"] = $productOnTop;
        // Hết sản phẩm nổi bật
        // Danh sách sản phẩm
        $ids = array_merge($category->descendants->pluck('id')
            ->toArray(), [$category->id]);

        // Tin tức

        $data["posts"] = $category->posts->take(7);

        // Text link
        $data["brands"] = TextLink::byModel(ProductCategory::class)->byType(1)
            ->where('model_id', $id)
            ->orderBy('sort', 'ASC')
            ->get();

        $data["productTypes"] = TextLink::byModel(ProductCategory::class)->byType(2)
            ->where('model_id', $id)
            ->orderBy('sort', 'ASC')
            ->get();
        // Hết text link

        $data["link"] = route('fe.product.category', ["id" => $category->id, 'slug' => $category->slug]);

        /* Set meta */
 
        $metaTitle = (!empty($category->seo->title)) ? $category->seo->title : $category->title;
        $metaDescription = strip_tags((!empty($category->seo->description)) ? $category->seo->description : $category->description);
        $metaImage = (!empty($category->seo->image)) ? $category->seo->image : (($category->thumbnail) ? $category->thumbnail : asset(config('admin.og_image_url')));
        $metaKeywords = (!empty($category->seo->keyword)) ? $category->seo->keyword : '';
        $canonical = (!empty($category->seo->canonical)) ? $category->seo->canonical : $data["link"];

        $robots = getMetaRobots($category->seo,0);
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('og:image', $metaImage)
            ->set('canonical', $canonical);
        if ($metaDescription) {
            meta()->set('description', $metaDescription)
                ->set('og:description', $metaDescription);
        }
        if ($metaKeywords) {
            meta()->set('keywords', $metaKeywords);
        }
        if ($robots) {
            meta()->set('robots', $robots);
        }
        /* Hết Set meta */

        return view('front_end.products.category', $data);
    }

    public function get(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $order = ProductOrder::where('product_category_id', $id)
            ->where('type', 'category')
            ->first();
        $sortSql = 'id';

        if (!empty($order->orders)) {
            $sortSql = DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')');
        }
        $productOnTop = null;
        if (!$request->has('price') && !$request->has('sort_type')) {
            $productOnTop = Product::with('productMedias.mediaFile')
                ->whereIn('product_category_id', $category->descendants->pluck('id'))
                ->where('show_on_top', true)
                ->orderByDesc($sortSql)
                ->orderByDesc('pin_to_top')
                ->take(20)
                ->get();
        }
        $data["productOnTop"] = $productOnTop;
        // Hết sản phẩm nổi bật
        // Danh sách sản phẩm
        $ids = array_merge($category->descendants->pluck('id')
            ->toArray(), [$category->id]);

        $products = Product::filter($request->all())
            ->with([
                'productCategory',
            ])
            ->whereIn('product_category_id', $ids)
            ->whereNotIn('id', $productOnTop ? $productOnTop->pluck('id') : []);

        $this->sortProducts($products);
        $products = $products
            ->paginate(16);
        $totalPage = $products->lastPage();
        return response()->json([
            'view' => view('front_end.products.elements.product-list', compact(
                'products'
            ))->render(),
            'totalPage' => $totalPage,
        ]);
    }

    public static function sortProducts($products)
    {
        static::baseSortProducts($products);
    }

    /**
     * Sort list of the resource.
     *
     * @param Product|mixed $products
     */
    public static function baseSortProducts($products): void
    {
        // $products->orderBy(DB::raw('FIELD(`status`, ' . Product::STATUS['sold'] . ')'));

        // Sort products.
        $sortType = request('sort_type');
        $sortDirection = request('sort_direction', 'desc');

        // Get real price.
        $rawSql = '(
            CASE
                WHEN `sale_price` IS NOT NULL AND `sale_price` != 0 AND ((`sale_from` IS NULL AND `sale_to` IS NULL) OR (`sale_from` <= NOW() AND `sale_to` >= NOW())) THEN `sale_price`
                ELSE `price`
            END
        )';

        $realPriceColumn = DB::raw($rawSql);
        $realPriceColumnAs = DB::raw('*, ' . $rawSql . ' AS `real_price`');

        switch ($sortType) {
            case 'price':
                $products->select($realPriceColumnAs)->orderBy('real_price', $sortDirection);
                break;
            case 'price_asc':
                $products->orderBy($realPriceColumn, 'asc');
                break;
            case 'price_desc':
                $products->orderBy($realPriceColumn, 'desc');
                break;
            case 'newest':
                $products->orderBy('updated_at', $sortDirection);
                break;
            case 'latest':
                $products->orderBy('created_at', $sortDirection);
                break;
            case 'top_rated':
                $products->orderBy('rate_count', $sortDirection)->orderBy('rate_star', $sortDirection);
                break;
            default:
                $order = [];
                $productCategory = array_filter(explode(',', request('product_categories')))[0] ?? [];

                if (!empty($productCategory)) {
                    $category = ProductCategory::with([
                        'ancestors' => function (AncestorsRelation $query) {
                            $query->select(['id', '_lft', '_rgt'])->orderByDesc('_lft');
                        },
                    ])->findOrFail($productCategory, ['id', '_lft', '_rgt']);

                    $ids = $category->ancestors->pluck('id')->prepend($category->id);

                    $order = ProductOrder::whereIn('product_category_id', $ids)
                        ->where('type', 'category')
                        ->orderBy(DB::raw('FIELD(`product_category_id`, ' . $ids->implode(', ') . ')'))
                        ->first();
                }

                if (!empty($order)) {
                    $products->orderByDesc(DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')'));
                } else {
                    $products->orderBy('pin_to_top', $sortDirection)
                        ->orderBy(DB::raw('price - sale_price'), $sortDirection);
                }
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function tag(Request $request, $slug, $id)
    {
        $productTag = ProductTag::with(['products'])->findOrFail($id);

        if ($productTag->slug != $slug) {
            return Redirect::to(route('fe.product.tag', ["slug" => $productTag->slug, 'id' => $productTag->id]), 301);
        }

        $data = [];

        $data["productTag"] = $productTag;

        $data["sliders"] = Slider::where('status', true)
            ->where('model', ProductTag::class)
            ->where('model_id', $id)
            ->orderBy('sort')
            ->orderByDesc('id')
            ->get();
        $data["banners"] = Banner::where('status', true)
            ->where('model', ProductTag::class)
            ->where('model_id', $id)
            ->orderBy('sort')
            ->orderByDesc('id')
            ->take(2)
            ->get();
        // Tin nổi bật
        $order = ProductOrder::where('product_category_id', $id)
            ->where('type', 'category')
            ->first();
        $sortSql = 'id';

        if (!empty($order->orders)) {
            $sortSql = DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')');
        }
        $productOnTop = [];

        if (!$request->has('price') && !$request->has('sort_type')) {
            $productOnTop = $productTag->products
                ->where('show_on_top', true)
                ->sortByDesc($sortSql)
                ->sortByDesc('pin_to_top')
                ->take(20);
        }
        $data["productOnTop"] = $productOnTop;
        // Hết sản phẩm nổi bật

        // Tin tức
        $data["posts"] = $productTag->posts;

        // Text link
        $data["brands"] = TextLink::byModel(ProductTag::class)->byType(1)
            ->where('model_id', $productTag->id)
            ->orderBy('sort', 'ASC')
            ->get();
        $data["productTypes"] = TextLink::byModel(ProductTag::class)->byType(2)
            ->where('model_id', $productTag->id)
            ->orderBy('sort', 'ASC')
            ->get();
        // Hết text link

        $data["link"] = route('fe.product.tag', ["id" => $productTag->id, 'slug' => $productTag->slug]);

        /* Set meta */
        $metaTitle = (!empty($productTag->seo->title)) ? $productTag->seo->title : $productTag->title;
        $metaDescription = strip_tags((!empty($productTag->seo->description)) ? $productTag->seo->description : $productTag->description);
        $metaImage = (!empty($productTag->seo->image)) ? $productTag->seo->image : (($productTag->thumbnail) ? $productTag->thumbnail : asset(config('admin.og_image_url')));
        $metaKeywords = (!empty($productTag->seo->keyword)) ? $productTag->seo->keyword : '';
        $canonical = (!empty($productTag->seo->canonical)) ? $productTag->seo->canonical : $data["link"];
        $robots = getMetaRobots($productTag->seo,0);
        meta()->set('title', $metaTitle)
            ->set('og:title', $metaTitle)
            ->set('og:image', $metaImage)
            ->set('canonical', $canonical);
        if ($metaDescription) {
            meta()->set('description', $metaDescription)
                ->set('og:description', $metaDescription);
        }
        if ($metaKeywords) {
            meta()->set('keywords', $metaKeywords);
        }
        if ($robots) {
            meta()->set('robots', $robots);
        }
        /* Hết Set meta */

        return view('front_end.products.tag', $data);
    }

    public function getProductByTag(Request $request, $id)
    {
        $productTag = ProductTag::findOrFail($id);

        $order = ProductOrder::where('product_category_id', $id)
            ->where('type', 'category')
            ->first();
        $sortSql = 'id';

        if (!empty($order->orders)) {
            $sortSql = DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')');
        }
        $productOnTop = null;
        if (!$request->has('price') && !$request->has('sort_type')) {
            $productOnTop = $productTag->products
                ->where('show_on_top', true)
                ->sortByDesc($sortSql)
                ->sortByDesc('pin_to_top')
                ->take(20);
        }
        $data["productOnTop"] = $productOnTop;
        // Hết sản phẩm nổi bật
        // Danh sách sản phẩm

        $products = $productTag->products()->filter($request->all())
            ->with([
                'productCategory',
            ])
            ->whereNotIn('id', $productOnTop ? $productOnTop->pluck('id') : []);

        $this->sortProducts($products);
        $products = $products
            ->paginate(16);
        $totalPage = $products->lastPage();
        return response()->json([
            'view' => view('front_end.products.elements.product-list', compact(
                'products'
            ))->render(),
            'totalPage' => $totalPage,
        ]);
    }
}
