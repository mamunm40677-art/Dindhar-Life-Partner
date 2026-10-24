<?php

namespace Database\Seeders;

use App\Models\SuccessStory;
use Illuminate\Database\Seeder;

class SuccessStorySeeder extends Seeder
{
    public function run(): void
    {
        $stories = [
            [
                'title' => 'আব্দুল্লাহ & ফাতেমা',
                'marriage_date' => 'বিবাহ: ফেব্রুয়ারি ২০২৪',
                'quote' => 'আলহামদুলিল্লাহ, দ্বীনদার লাইফ পার্টনারের মাধ্যমে খুব দ্রুত ও সুন্নতি নিয়মে অভিভাবকের উপস্থিতিতে আমাদের বিবাহ সম্পন্ন হয়েছে।',
                'image_url' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80',
                'link_url' => '#',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'মাহমুদ & আয়েশা',
                'marriage_date' => 'বিবাহ: এপ্রিল ২০২৪',
                'quote' => 'অভিভাবকদের সরাসরি অংশগ্রহণ এবং পর্দার বিধান পুরোপুরি মেনে বিয়ের আয়োজনে আমরা অত্যন্ত সন্তুষ্ট। ধন্যবাদ!',
                'image_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80',
                'link_url' => '#',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'ওমর & খাদিজা',
                'marriage_date' => 'বিবাহ: জুন ২০২৪',
                'quote' => 'বায়োডাটার তথ্যগুলো নিখুঁত ছিল। বিশেষ করে ফিল্টার পছন্দমতো সঠিক দ্বীনদার জীবনসঙ্গী নির্বাচন সহজ করেছে।',
                'image_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=600&q=80',
                'link_url' => '#',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($stories as $storyData) {
            SuccessStory::updateOrCreate(
                ['title' => $storyData['title']],
                $storyData
            );
        }
    }
}
