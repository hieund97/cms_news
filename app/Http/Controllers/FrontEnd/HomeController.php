<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Option;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOrder;
use App\Models\Slider;
use App\Models\TextLink;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Kalnoy\Nestedset\DescendantsRelation;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data["sliders"] = Slider::where('status', true)
            ->where('model', 'Home')
            ->where('model_id', 0)
            ->orderBy('sort')
            ->orderByDesc('id')
            ->get();
        $data["banners"] = Banner::where('status', true)
            ->where('model', 'Home')
            ->orderBy('sort')
            ->orderByDesc('id')
            ->take(3)
            ->get();
        $data["saleProducts"] = Product::inSaleTime()->with('productCategory')
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $products = Collection::make([]);
        $categories = ProductCategory::with([
            'descendants' => function (DescendantsRelation $query) {
                $query->select(['id', 'title', 'slug', '_lft', '_rgt'])/*->where('is_menu_top', true)*/
                ;
            },
            'homeTextLinks',
        ])
            ->whereNull('parent_id')
            ->where('is_menu_home', true)
            ->orderBy('ordering_menu_home')
            ->get(['id', 'title', 'slug', '_lft', '_rgt']);

        $orders = ProductOrder::whereIn('product_category_id', $categories->pluck('id'))
            ->where('type', 'home')
            ->get();

        foreach ($categories as $category) {
            $limit = 20;
            $order = $orders->where('product_category_id', $category->id)->first();

            $sortSql = 'id';

            if (!empty($order->orders)) {
                $sortSql = DB::raw('FIELD(`id`, ' . implode(',', array_reverse(explode(',', $order->orders))) . ')');
            }

            $ids = array_merge($category->descendants->pluck('id')
                ->toArray(), [$category->id]);

            $products = $products->merge(
                Product::whereIn('product_category_id', $ids)
                    ->where('show_on_top', true)
                    ->orderByDesc($sortSql)
                    ->orderByDesc('pin_to_top')
                    ->take($limit)
                    ->get()
                    ->transform(function ($product) use ($category) {
                        $product->root_product_category_id = $category->id;
                        $product->productCategory = $category->descendants
                            ->where('id', $product->product_category_id)
                            ->first();

                        return $product;
                    })
            );
        }

        $products->load([
            'productMedias.mediaFile',
        ]);

        $data["categories"] = $categories;
        $data["products"] = $products;

        // Tin tức

        $posts_featured = Post::with('categories')
            ->where('is_home_featured', true)
            ->where('status', array_search('publish', Post::STATUS))
            ->orderBy('published_at', 'desc')
            ->take(1)->get();
        $posts = Post::with('categories')
            ->where('status', array_search('publish', Post::STATUS))
            ->where('is_home_featured', false)
            ->orderBy('published_at', 'desc')
            ->take(4)->get();
        $expPosts = Post::with('categories')
            ->where('is_experience', true)
            ->where('status', array_search('publish', Post::STATUS))
            ->orderBy('published_at', 'desc')
            ->take(2)->get();

        $data["posts_featured"] = $posts_featured;
        $data['posts'] = $posts;
        $data["expPosts"] = $expPosts;

        // Hết tin tức

        // Text link
        $data["brands"] = TextLink::byModel('Home')->byType(1)
            ->orderBy('sort', 'ASC')
            ->get();

        $data["productTypes"] = TextLink::byModel('Home')->byType(2)
            ->orderBy('sort', 'ASC')
            ->get();
        // Hết text link
        $metaTitles = Option::where('option_name', 'site_name')->pluck('option_value');
        $metaDescriptions = Option::where('option_name', 'site_description')->pluck('option_value');
        /* Set meta */
        $metaTitle = 'Hệ thống chuyên cung cấp đồ chơi,nội thất ô tô giá rẻ,hàng chính hãng!';
        $metaDescription = 'Nội thất Ô tô | chungauto.vn chuyên cung cấp dịch vụ Phân phối sản phẩm mới - thu mua sản phẩm cũ
        và sửa chữa toàn bộ sản phẩm DVD - CD ô tô tất cả các thương hiệu như: Mazda, Ford Fiesta, hyundai, honda...';
        $robots = getMetaRobots('',0);
        meta()->set('title', $metaTitles[0] ? $metaTitles[0] : $metaTitle)
            ->set('og:title', $metaTitles[0] ? $metaTitles[0] : $metaTitle)
            ->set('description', $metaDescriptions[0] ? $metaDescriptions[0] : $metaDescription)
            ->set('og:description', $metaDescriptions[0] ? $metaDescriptions[0] : $metaDescription)
            ->set('keywords', 'phu tung, oto')
            ->set('og:image', asset(config('admin.og_image_url')))
            ->set('canonical', route('fe.home'));

        if ($robots) {
            meta()->set('robots', $robots);
        }
        /* Hết Set meta */
        return view('front_end.home.index', $data);
    }
}
