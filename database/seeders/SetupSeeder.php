<?php

namespace Database\Seeders;

use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Jaka Sianturi',
            'email' => 'jakasianturi00@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'user_role' => 'admin',
        ]);
        User::insert([
            'name' => 'Member',
            'email' => 'member@mail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'user_role' => 'member',
        ]);

        Setting::insert([
            'site_name' => 'Perpustakaanku',
            'site_footer' => 'Perpustakaanku',
            'logo' => '',
            'favicon' => '',
            'ga_code' => '',
            'social_facebook' => '#',
            'social_twitter' => '#',
            'social_instagram' => '#',
            'email' => 'jakasianturi00@gmail.com',
            'phone' => '',
            'google_map' => '',
            'address' => '',
            'about_title' => 'Tentang Kami',
            'about_thumbnail' => '',
            'about_content' => '',
            'meta_description' => '',
            'meta_keyword' => '',
        ]);

        Category::insert([
            'category_name' => 'Tidak Berkategori',
            'slug' => 'tidak-berkategori',
        ]);

        Bookshelf::insert([
            'bookshelf_name' => 'Tidak Ada Rak',
        ]);
    }
}