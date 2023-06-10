<?php

use Illuminate\Database\Seeder;
use App\Models\Navigation;

class FooterLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \JsonException
     */
    public function run()
    {
        $navigations = [
            
            [
                'name' => 'Giới thiệu',
                'icon' => null,
                'link' => '1',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Liên hệ',
                'icon' => null,
                'link' => '2',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Tuyển dụng',
                'icon' => null,
                'link' => '3',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Sản phẩm khuyến mại',
                'icon' => null,
                'link' => '4',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Sản phẩm bán chạy',
                'icon' => null,
                'link' => '5',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Hệ thống đại lý',
                'icon' => null,
                'link' => '6',
                'group' => 'company',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Chăm sóc khách hàng',
                'icon' => null,
                'link' => '7',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Chính sách khách hàng',
                'icon' => null,
                'link' => '8',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Chính sách bảo hành',
                'icon' => null,
                'link' => '9',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Chính sách đổi trả',
                'icon' => null,
                'link' => '10',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Hình thức thanh toán',
                'icon' => null,
                'link' => '11',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
            [
                'name' => 'Chính sách bảo mật',
                'icon' => null,
                'link' => '12',
                'group' => 'customer',
                'display_in' => 'footer',
            ],
        ];

        Navigation::insert($navigations);
    }
}
