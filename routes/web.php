<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Imports\ProductWarranty;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/cp_admin/login', 'AuthController@showLoginForm')->name('login');
    Route::post('/cp_admin/login', 'AuthController@login');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'cp_admin'], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::post('/cp_admin/logout', 'AuthController@logout')->name('logout');
    Route::resource('users', 'AdminController')->except('show');
    Route::get('profile/password', 'ProfileController@password')->name('profile.password');
    Route::put('profile/password', 'ProfileController@updatePassword');
    Route::resource('buyers', 'UserController')->except('show');
    Route::resource('roles', 'RoleController')->except(['create', 'show', 'edit']);
    Route::resource('product_categories', 'ProductCategoryController')->except(['show']);
    Route::get('product_categories/list', 'ProductCategoryController@list')
        ->name('product_categories.list');
    Route::get('product_categories/load_sub_cate', 'ProductCategoryController@loadSubCate')
        ->name('product_categories.load_sub_cate');
    Route::post('product_categories/save_order_cate', 'ProductCategoryController@saveOrderCate')
        ->name('product_categories.save_order_cate');
    Route::get('product_categories/show_menu/{type}', 'ProductCategoryController@showMenu')
        ->name('product_categories.show_menu');

    Route::resource('categories', 'CategoryController')->except(['create', 'show', 'edit']);
    Route::resource('post_tags', 'PostTagController')->except(['create', 'show', 'edit']);
    Route::resource('product_tags', 'ProductTagController')->except(['create', 'show', 'edit']);
    Route::get('posts/export', 'PostController@export')->name('posts.export');
    Route::get('posts/tags', 'PostController@tags')->name('posts.tags');
    Route::post('posts/quick_update', 'PostController@quickUpdate')->name('posts.quick_update');
    Route::resource('posts', 'PostController');

    Route::get('getPostForProduct', [\App\Http\Controllers\PostController::class, 'getPostForProduct'])
        ->name('getPostForProduct');

    Route::resource('settings', 'SettingController')->except(['create', 'show', 'edit']);
    Route::get('settings/log', 'SettingController@log')->name('settings.log');
    Route::post('settings/update', 'SettingController@update')->name('settings.update');

    Route::post('reviews/quick_update', [\App\Http\Controllers\ReviewController::class, 'quickUpdate'])
        ->name('reviews.quick_update');
    Route::resource('reviews', 'ReviewController');

    Route::get('discussion/get', [\App\Http\Controllers\DiscussionController::class, 'getData'])
        ->name('discussion.getData');
    Route::post('discussion/quick_update', [\App\Http\Controllers\DiscussionController::class, 'quickUpdate'])
        ->name('discussion.quick_update');
    Route::delete('discussion/delete', [\App\Http\Controllers\DiscussionController::class, 'destroy'])
        ->name('discussion.destroy');

    Route::resource('coupons', 'CouponController')->except(['show', 'edit']);
    Route::resource('orders', 'OrderController');
    Route::post('orders/editable', 'OrderController@editable')->name('orders.editable');
    Route::post('orders/quick_update', 'OrderController@quickUpdate')->name('orders.quick_update');
    Route::get('orders/print/{order}', 'OrderController@print')->name('orders.print');
    Route::post('sliders/quick_update', 'SliderController@quickUpdate')->name('sliders.quick_update');
    Route::resource('sliders', 'SliderController');

    Route::delete('banners/{model}/{model_id}', 'BannerController@destroyModel')->name('banners.delete_model');
    Route::post('banners/update_home', 'BannerController@updateHome')->name('banners.update_home');
    Route::get('banners/list/{type}/{id}', 'BannerController@listBanners');
    Route::resource('banners', 'BannerController');

    Route::resource('redirections', 'RedirectionController');
    Route::post('redirection/export', [\App\Http\Controllers\RedirectionController::class,'export'])->name('redirection.export');

    Route::get('brands/get', 'BrandController@brands')->name('brands.get');
    Route::resource('brands', 'BrandController');
    Route::post('brands/order', 'BrandController@brandOrder')->name('brands.order');
    Route::delete('brands/orders/{order}', 'BrandController@destroyOrder')->name('brands.destroyOrder');
    Route::resource('branches', 'BranchController');

    Route::resource('tags', 'TagController');

    Route::post('seos/quick_update', 'SeoController@quickUpdate')->name('seos.quick_update');
    Route::resource('seos', 'SeoController');
    Route::resource('item_relates', 'ItemRelateController');

    Route::get('products/sort', 'ProductController@sort')->name('products.sort');
    Route::post('products/sort', 'ProductController@saveSort');
    Route::get('products/top_items/{category}', 'ProductController@getTopItems');
    Route::get('products/sort/{category}', 'ProductController@showSort')->name('products.sort.show');
    Route::get('products/sort_by_category/{category}', 'ProductController@sortByCategory')
        ->name('products.sort_by_category');
    Route::delete('products/remove_sort/{product_order}', 'ProductController@removeSort');
    Route::get('products/export', 'ProductController@export')->name('products.export');
    Route::get('products/tags', 'ProductController@tags')->name('products.tags');
    Route::get('products/delete/list', 'ProductController@deleteList')->name('products.delete.list');
    Route::post('products/delete/restore/{id}', 'ProductController@restoreProductDelete')->name('products.delete.restore');

    Route::resource('products', 'ProductController');
    Route::get('accessories', [\App\Http\Controllers\ProductController::class, 'accessories'])
        ->name('products.accessories');
    Route::post('products/quick_update', 'ProductController@quickUpdate')->name('products.quick_update');
    Route::get('products/{product}/logs', 'ProductController@logs')->name('products.logs');

    Route::resource('pages', 'PageController')->except(['show']);
    Route::get('/pages/{page}/preview', 'PageController@preview');

    Route::post('banners/priority', 'BannerController@priority')->name('banners.priority');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::post('branches_priority', 'BranchController@priority')->name('branches.priority');

    Route::get('menu', 'MenuController@index')->name('menus.index');

    // Ajax Chung

    Route::post('ajax/slug/', 'AjaxController@slug')->name('ajax.slug');

    // Text link

    Route::get('text_links/get_category', 'TextLinkController@getCategory')->name('text_links.get_category');
    Route::post('text_links/quick_update', 'TextLinkController@quickUpdate')->name('text_links.quick_update');
    Route::resource('text_links', 'TextLinkController')->except(['show']);
    Route::post('text_links/export', 'TextLinkController@export')->name('text_links.export');

    //Navigation
    Route::resource('navigations', 'NavigationController');
    Route::post('update/{id}/{navigation}', 'NavigationController@updateNavigation')
        ->name('navigations.updateNavigation');

    Route::get('/update_content', function () {

        $products = \App\Models\Product::all();

        foreach($products as $row){
            $content = addNofollowContent($row["description"]);
            \App\Models\Product::where("id",$row["id"])->update(["description"=>$content]);
        }  
    });    

    // xóa hết cache
    Route::get('/clear-cache', function () {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Cache::flush();
        return "Cache is cleared";
    })->name('clear-cache');
});

Route::get('locations/district', 'LocationController@district')->name('locations.district');
Route::get('locations/ward', 'LocationController@ward')->name('locations.ward');

Route::get('/', [\App\Http\Controllers\FrontEnd\HomeController::class, 'index'])->name('fe.home');
Route::get('/gio-hang', [\App\Http\Controllers\FrontEnd\CartController::class, 'index'])->name('fe.cart');
Route::post('/gio-hang', 'FrontEnd\CartController@addItemToCart')->name('fe.cart.add');
Route::post('/gio-hang/save', 'FrontEnd\CartController@save')->name('fe.cart.save');
Route::put('/gio-hang', 'FrontEnd\CartController@update')->name('fe.cart.update');
Route::delete('/gio-hang/remove_item', 'FrontEnd\CartController@destroy')->name('fe.cart.destroy');
Route::get('/dat-hang-thanh-cong', 'FrontEnd\CartController@checkOut')->name('fe.checkout');

/** ----Tin tức --- */
Route::get('/tin-tuc', [\App\Http\Controllers\FrontEnd\PostController::class, 'index'])->name('fe.post.index');
Route::get('/tim-kiem/tin-tuc', [\App\Http\Controllers\FrontEnd\PostController::class, 'search'])->name('fe.post.search');

Route::get('/danh-sach-tin-tuc', [\App\Http\Controllers\FrontEnd\PostController::class, 'getPost'])
    ->name('fe.post.getPost');
Route::get('/{slug}-e{id}.html', [\App\Http\Controllers\FrontEnd\PostController::class,'category'])
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.post.category');
Route::get('/danh-muc/danh-sach-tin-tuc/{id}', [
    \App\Http\Controllers\FrontEnd\PostController::class,
    'getPostCategory',
])->name('fe.post.category.getPost');

Route::get('{slug}-g{id}.html', 'FrontEnd\PostController@tag')
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.post.tag');
Route::get('/post/tag/{id}', [\App\Http\Controllers\FrontEnd\PostController::class, 'getPostTag'])
    ->name('fe.post.tag.getPostTag');

Route::get('/{slug}-{id}.html', [\App\Http\Controllers\FrontEnd\PostController::class,'show'])
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.post');

/** ---- Hết Tin tức --- */
//Review
Route::post('/postRatingImage', [\App\Http\Controllers\FrontEnd\ReviewController::class, 'postRatingImage'])
    ->name('postRatingImage');
Route::post('/SubmitRatingComment', [\App\Http\Controllers\FrontEnd\ReviewController::class, 'submitRatingComment'])
    ->name('submitRatingComment');
Route::post('/submitDiscussion', [\App\Http\Controllers\FrontEnd\DiscussionController::class, 'submitDiscussion'])
    ->name('submitDiscussion');
//End Review
/** ---- Sản phẩm --- */

Route::get('/product/get/{id}', [\App\Http\Controllers\FrontEnd\ProductController::class, 'get'])
    ->name('fe.product.get');

Route::get('/{slug}-c{id}.html', 'FrontEnd\ProductController@category')
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.product.category');

Route::get('{slug}-t{id}.html', 'FrontEnd\ProductController@tag')
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.product.tag');

Route::get('/product/tag/{id}', [\App\Http\Controllers\FrontEnd\ProductController::class, 'getProductByTag'])
    ->name('fe.product.getProductByTag');

Route::get('/{slug}-p{id}.html', [\App\Http\Controllers\FrontEnd\ProductController::class, 'show'])
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.product');

Route::get('danh-gia/{slug}-p{id}.html', [\App\Http\Controllers\FrontEnd\ProductController::class, 'review'])
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.product.review');

/** ---- Hết sản phẩm --- */

Route::get('tim-kiem', 'FrontEnd\SearchController@index')->name('fe.search.index');
Route::get('search/suggest', 'FrontEnd\SearchController@suggest')->name('fe.search.suggest');
Route::get('/search/get', [\App\Http\Controllers\FrontEnd\SearchController::class, 'get'])->name('fe.search.get');

/** ---- Page --- */
Route::get('p/{slug}-p{id}.html', 'FrontEnd\PageController@show')
    ->where(['slug' => '([÷a-zA-Z0-9\-]+)', 'id' => '(\d+)'])
    ->name('fe.page.show');
/** ---- Hết Page --- */


/** ---- Sitemap --- */
Route::get('sitemap.xml', 'FrontEnd\SiteMapController@index')->name('fe.sitemap');
Route::get('sitemap_product_category.xml', 'FrontEnd\SiteMapController@productCategories')->name('fe.sitemap_product_category');
Route::get('sitemap_product.xml', 'FrontEnd\SiteMapController@products')->name('fe.sitemap_product');
Route::get('sitemap_product_tag.xml', 'FrontEnd\SiteMapController@productTags')->name('fe.sitemap_product_tag');
Route::get('sitemap_article.xml', 'FrontEnd\SiteMapController@posts')->name('fe.sitemap_article');
Route::get('sitemap_article_category.xml', 'FrontEnd\SiteMapController@categories')->name('fe.sitemap_article_category');
Route::get('sitemap_article_tag.xml', 'FrontEnd\SiteMapController@postTags')->name('fe.sitemap_article_tag');
Route::get('sitemap_page.xml', 'FrontEnd\SiteMapController@page')->name('fe.sitemap_page');

/** ---- Hết Sitemap --- */


