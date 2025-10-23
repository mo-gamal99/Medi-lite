<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1], // always keep single settings row
            [
                'website_name' => 'موقع طبي',
                'website_name_en' => 'Medical Website',
                'subscription_title' => 'اشترك الآن معنا',
                'phone' => '+966500000000',
                'image' => null,
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'description' => 'وصف الموقع الطبي... يمكن تغييره من لوحة التحكم',
                'address' => 'الرياض - السعودية',
                'email' => 'info@example.com',
                'google_play' => null,
                'apple_store' => null,
                'logo' => null,
                'instagram' => null,
                'phone_number' => '+966500000000',
                'snap' => null,
                'tiktok' => null,
                'tax_number' => '1234567890',
                'value_added_tax' => 15.00,
                'publishable_key' => null,
                'secret_key' => null,
                'sms_api_key' => null,
                'sms_user_name' => null,
                'sms_sender' => null,
            ]
        );
    }
}
