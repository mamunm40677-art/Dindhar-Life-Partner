<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'ফ্রি প্যাকেজ',
                'slug' => 'free',
                'subtitle' => 'বায়োডাটা জমা দেওয়ার জন্য',
                'badge' => 'ফ্রি ট্রায়াল',
                'price' => 0,
                'period' => '/ আজীবন ফ্রি',
                'connection_limit' => 0,
                'features' => [
                    '১টি বায়োডাটা সম্পূর্ণ ফ্রিতে তৈরি',
                    'পাবলিক প্রোফাইলে বায়োডাটা প্রদর্শন',
                    'আনলিমিটেড বায়োডাটা ব্রাউজিং ও ফিল্টার',
                    'বেসিক হেল্পলাইন কাস্টমার সাপোর্ট'
                ],
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 1,
                'button_text' => 'বিনামূল্যে বায়োডাটা খুলুন',
                'button_link' => '/register',
            ],
            [
                'name' => 'স্ট্যান্ডার্ড প্যাকেজ',
                'slug' => 'standard',
                'subtitle' => 'অভিভাবকের নম্বর নেওয়ার জন্য',
                'badge' => 'সবচেয়ে জনপ্রিয়',
                'price' => 1200,
                'period' => '/ ৩টি অভিভাবকের নম্বর',
                'connection_limit' => 3,
                'features' => [
                    '৩টি বায়োডাটার অভিভাবকের সরাসরি ফোন নম্বর',
                    '৫০০ দিন মেয়াদ ও রিয়েল-টাইম কানেকশন',
                    'এসএমএস ও ইমেইল ইনস্ট্যান্ট এলার্ট',
                    'নিবেদিত সাপোর্ট ম্যানেজার সুবিধা'
                ],
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 2,
                'button_text' => 'প্যাকেজ সাবস্ক্রাইব করুন',
                'button_link' => '/contact',
            ],
            [
                'name' => 'গোল্ড ভিআইপি প্যাকেজ',
                'slug' => 'gold-vip',
                'subtitle' => 'বিশেষ অগ্রাধিকার সুবিধার জন্য',
                'badge' => 'ভিআইপি সার্ভিস',
                'price' => 2500,
                'period' => '/ ৭টি অভিভাবকের নম্বর',
                'connection_limit' => 7,
                'features' => [
                    '৭টি বায়োডাটার সরাসরি অভিভাবক নম্বর',
                    'টপ লিস্টে বায়োডাটা হাইলাইট করার সুযোগ',
                    'সরাসরি বিবাহ কনসালট্যান্সি ও বিশেষ সহায়তা',
                    'সর্বোচ্চ কাস্টমার কেয়ার সার্ভিস সাপোর্ট'
                ],
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 3,
                'button_text' => 'ভিআইপি সাবস্ক্রিপশন নিন',
                'button_link' => '/contact',
            ],
        ];

        foreach ($plans as $planData) {
            Plan::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData
            );
        }
    }
}
