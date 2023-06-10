<?php


use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            'site_name' => ['value' => 'CHUNG AUTO ONLINE', 'type' => ''],
            'site_description' => ['value' => '', 'type' => ''],
            'admin_email' => ['value' => 'ductuongquan1@gmail.com', 'type' => ''],
            'hotline' => ['value' => '0976460950', 'type' => ''],
            'shop_list_url' => ['value' => '', 'type' => ''],
            'facebook_url' => ['value' => 'https://www.facebook.com/laptrinhchonguoimoibatdau', 'type' => ''],
            'youtube_url' => [
                'value' => 'https://www.youtube.com/NguyenVanDucLapTrinhVien?sub_confirmation=1',
                'type' => '',
            ],
            'twitter_url' => ['value' => 'https://twitter.com/home', 'type' => ''],
            'instagram_url' => ['value' => 'https://www.instagram.com/ducnvna/', 'type' => ''],
            'phone_company' => ['value' => '092.55.88.666', 'type' => ''],
            'address_company' => [
                'value' => 'Số 87, Phố Thiên Hiền, Đình Thôn, Mỹ Đình, Từ Liêm, TP. Hà Nội',
                'type' => '',
            ],
            'robots' => ['value' => 'noindex, nofollow', 'type' => ''],
            'footer' => ['value' => '', 'type' => 'textarea'],
            'header' => ['value' => '', 'type' => 'textarea'],
            'messenger' => ['value' => 'https://www.messenger.com/t/ChungAuto.vncom', 'type' => ''],
            'zalo' => ['value' => '0925588666', 'type' => ''],
            'seo_schema' => ['value' => '', 'type' => 'textarea'],
            'cart_successfull' => ['value' => '', 'type' => 'textarea'],
            'is_popup' => ['value' => '', 'type' => 'checkbox'],
            'popup' => ['value' => '', 'type' => 'textarea'],
            'popup_start' => ['value' => '', 'type' => ''],
            'popup_time' => ['value' => '', 'type' => ''],
            'buy_contact' => ['value' => '', 'type' => ''],
            'post_description' => ['value' => '', 'type' => 'textarea'],
            'post_banner' => ['value' => '', 'type' => 'upload'],
            'post_banner_url' => ['value' => '', 'type' => ''],
            'captcha_secret' => ['value' => '', 'type' => ''],
            'captcha_sitekey' => ['value' => '', 'type' => ''],
            'policy_sell_product' => ['value' => '', 'type' => 'textarea'],
            'policy_exchange' => ['value' => '', 'type' => 'textarea'],
            'dmca' => ['value' => '', 'type' => 'textarea'],
        ];

        foreach ($options as $name => $row) {
            if (!Option::where('option_name', '=', $name)->exists()) {
                Option::create([
                    'option_name' => $name,
                    'option_value' => $row["value"],
                    'option_type' => $row["type"],
                ]);
            }
        }
    }
}
