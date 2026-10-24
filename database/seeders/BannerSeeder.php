<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::updateOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'বর্তমান নিবন্ধিত বায়োডাটা: ৩,৪৫৭+ টি',
                'title' => 'পবিত্র ও সুন্নতি উপায়ে দ্বীনদার জীবনসঙ্গী নির্বাচন করুন',
                'subtitle' => 'পর্দা ও শরীয়াহ শতভাগ বজায় রেখে অভিভাবকের প্রত্যক্ষ তত্ত্বাবধানে সঠিক দ্বীনদার পাত্র-পাত্রী খোঁজার একমাত্র বিশ্বস্ত প্রিমিয়াম ইসলামিক ম্যাট্রিমোনিয়াল প্ল্যাটফর্ম।',
                'image_url' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&fit=crop&w=1100&q=85',
                'image_caption' => 'পবিত্র সম্পর্কের সূচনায় শরীয়াহভিত্তিক একমাত্র বিশ্বস্ত প্ল্যাটফর্ম',
                'button1_text' => '📁 বিনামূল্যে বায়োডাটা জমা দিন',
                'button1_link' => '/register',
                'button2_text' => '👥 বায়োডাটা ব্রাউজ করুন',
                'button2_link' => '#search-filter',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );
    }
}
