<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Menu;
use Cache;
use App\Models\Option;
use App\Models\Branch;
use App\Models\Navigation;
use Config;

class NavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $navigation = [
            [
                'name' => __('Dashboard'),
                'link' => route('dashboard'),
                'icon' => 'fa-tachometer-alt',
                'permission' => 'dashboard.index',
            ],
            [
                'name' => __('Category Product Manager'),
                'link' => '#',
                'icon' => 'fa-list-alt',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('product_categories.index'),
                        'permission' => 'product_categories.index',
                    ],

                    [
                        'name' => __('Sort'),
                        'link' => route('product_categories.list'),
                        'permission' => 'product_categories.list',
                        'include' => ['product_categories.show_menu']
                    ],          

                ],
            ],
            [
                'name' => __('Product Manager'),
                'link' => '#',
                'icon' => 'fa-camera',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('products.index'),
                        'permission' => 'products.index',
                        'include' => [
                            'products.show',
                            'products.edit',
                            'products.sort',
                        ],
                    ],
                    [
                        'name' => __('Add'),
                        'link' => route('products.create'),
                        'permission' => 'products.store',
                        'include' => [
                            'products.attributes',
                            'products.skus',
                        ],
                    ],

                    [
                        'name' => __('Deal Zone'),
                        'link' => route('products.index',['in_sale_time'=>2]),
                        'permission' => 'products.index',
                    ],
                   
                ],
            ],

            [
                'name' => __('Posts Manager'),
                'link' => '#',
                'icon' => 'fa-newspaper',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('posts.index'),
                        'permission' => 'posts.index',
                        'include'=>['posts.edit']
                    ],
                    [
                        'name' => __('Add'),
                        'link' => route('posts.create'),
                        'permission' => 'posts.store',
                    ],
                    [
                        'name' => __('Category'),
                        'link' => route('categories.index'),
                        'permission' => 'categories.index',
                    ],
                ],
            ],
            [
                'name' => __('Ads Manager'),
                'link' => '#',
                'icon' => 'fa-ad',
                'children' => [
                    [
                        'name' => __('List of sliders'),
                        'link' => route('sliders.index'),
                        'permission' => 'sliders.index',
                        'include' => [
                            'sliders.edit',
                        ],
                    ],
                    [
                        'name' => __('Create slider'),
                        'link' => route('sliders.create'),
                        'permission' => 'sliders.store',
                    ],

                    [
                        'name' => __('List of banners'),
                        'link' => route('banners.index'),
                        'permission' => 'banners.index',
                        'include' => [
                            'banners.edit',
                        ],
                    ],
                    [
                        'name' => __('Create banner'),
                        'link' => route('banners.create'),
                        'permission' => 'banners.store',
                    ],
                ],
            ],
            [
                'name' => __('Pages Manager'),
                'link' => '#',
                'icon' => 'fa-external-link-alt',
                'children' => [
                    [
                        'name' => __('List of pages'),
                        'link' => route('pages.index'),
                        'permission' => 'pages.index',
                    ],
                    [
                        'name' => __('Create Page'),
                        'link' => route('pages.create'),
                        'permission' => 'pages.store',
                    ],
                ],
            ],
            [
                'name' => __('Seo Manager'),
                'link' => '#',
                'icon' => 'fa-filter',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('seos.index',['model'=>'App\\Models\\Product']),
                        'permission' => 'seos.index',
                        'include' => ['seos.index','seos.edit'],
                    ],
                   
                ],
            ],
            [
                'name' => __('Tags Manager'),
                'link' => '#',
                'icon' => 'fa-tag',
                'children' => [
                    [
                        'name' => __('Product tag'),
                        'link' => route('product_tags.index'),
                        'permission' => 'product_tags.index',
                    ],
                    [
                        'name' => __('Post tag'),
                        'link' => route('post_tags.index'),
                        'permission' => 'post_tags.index',
                    ],
                ],
            ],
            [
                'name' => __('Text Link Manager'),
                'link' => '#',
                'icon' => 'fa-link',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('text_links.index'),
                        'permission' => 'text_links.index',
                    ],
                    [
                        'name' => __('text_links.store'),
                        'link' => route('text_links.create'),
                        'permission' => 'text_links.store',
                        'include' => [
                            'text_links.edit',
                        ],
                    ],
                ],
            ],
            [
                'name' => __('Redirections Manager'),
                'link' => '#',
                'icon' => 'fa-forward',
                'children' => [
                    [
                        'name' => __('List of redirections'),
                        'link' => route('redirections.index'),
                        'permission' => 'redirections.index',
                    ],
                    [
                        'name' => __('redirections.store'),
                        'link' => route('redirections.create'),
                        'permission' => 'redirections.store',
                    ],
                ],
            ],
            [
                'name' => __('Order Manager'),
                'link' => route('orders.index'),
                'icon' => 'fa-shopping-cart',
                'permission' => 'orders.index',
                'include' => [
                    'orders.create',
                    'orders.edit',
                    'orders.show',
                ],
            ],

            [
                'name' => __('Reviews Manager'),
                'link' => route('reviews.index'),
                'icon' => 'fa-comments',
                'permission' => 'reviews.index',
                'include' => [
                    'reviews.create',
                    'reviews.edit',
                ],
            ],
            [
                'name' => __('Media'),
                'link' => route('media.index'),
                'icon' => 'fa-image',
                'permission' => 'media.index',
            ],

            [
                'name' => __('System Settings'),
                'link' => '#',
                'icon' => 'fa-cog',
                'children' => [
                    [
                        'name' => __('Setting'),
                        'link' => route('settings.index'),
                        'permission' => 'settings.index',
                    ],
                    [
                        'name' => __('System logs'),
                        'link' => route('settings.log'),
                        'permission' => 'settings.log',
                    ],
                    [
                        'name' => __('Branches'),
                        'link' => route('branches.index'),
                        'permission' => 'branches.index',
                        'include' => ['branches.create']
                    ],

                ],
            ],

            [
                'name' => __('Menu Manager'),
                'link' => '#',
                'icon' => 'fa-users',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('menus.index'),
                        'permission' => 'menus.index',
                    ],
        
                ],
            ],

            
            [
                'name' => __('Footer Manager'),
                'link' => '#',
                'icon' => 'fa-external-link-alt',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('navigations.index'),
                        'permission' => 'navigations.index',
                        'include' => ['navigations.edit'],
                    ],
                    [
                        'name' => __('Add'),
                        'link' => route('navigations.create'),
                        'permission' => 'navigations.store',
                    ],
                ],
            ],

            [
                'name' => __('Users Manager'),
                'link' => '#',
                'icon' => 'fa-user',
                'children' => [
                    [
                        'name' => __('List'),
                        'link' => route('users.index'),
                        'permission' => 'users.index',
                    ],
                    [
                        'name' => __('Add'),
                        'link' => route('users.create'),
                        'permission' => 'users.store',
                    ],
                    [
                        'name' => __('List of roles'),
                        'link' => route('roles.index'),
                        'permission' => 'roles.index',
                    ],
                ],
            ],

        ];
       
        // Menu
        $mainMenus = Cache::rememberForever('main-menu', function() { 
            return Menu::getByName('Main-menu');
        });

        // Setting 
        $mainSettings = Cache::rememberForever('main-setting', function() { 
            
            $settings = Option::get();

            $tempSettings = [];
    
            foreach ($settings as $setting) {
                $tempSettings[$setting->option_name] = $setting->option_value;
            }

            // 
            Config::set('captcha.secret', $tempSettings['captcha_secret']);
            Config::set('captcha.sitekey', $tempSettings['captcha_sitekey']);
    
            return $tempSettings;
        });
        // Danh sách chi nhánh

        $mainBranches = Cache::rememberForever('main-branch', function() { 
            return Branch::orderByDesc('sort')->get();
        });

        // Footer
        $mainFooters = Cache::rememberForever('main-footer', function() { 
            return Navigation::where('display_in', 'footer')
                            ->orderByDesc('order')
                            ->get([
                                'id',
                                'name',
                                'icon',
                                'link',
                                'group',
                                'display_in',
                                'order',
                            ])
                            ->groupBy('group');
        });
        $view->with(compact('navigation','mainMenus','mainSettings','mainBranches','mainFooters'));
    }
}
