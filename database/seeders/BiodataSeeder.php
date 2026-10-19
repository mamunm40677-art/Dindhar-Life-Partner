<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Seeder;

class BiodataSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'name' => 'Abdullah',
                'email' => 'abdullah@example.com',
                'display_name' => 'Abdullah',
                'gender' => 'groom',
                'age' => 28,
                'marital_status' => 'never_married',
                'city' => 'ঢাকা (উত্তরা)',
                'education' => 'বিএসসি ইন কম্পিউটার সায়েন্স',
                'occupation' => 'সফটওয়্যার ইঞ্জিনিয়ার',
                'about' => 'সৎ ও দ্বীনদার পাত্র, ৫ ওয়াক্ত নামাযী। পরিবারের সম্মতিতে বায়োডাটা জমা দেওয়া হয়েছে।',
                'published' => true,
            ],
            [
                'name' => 'Sumaiya',
                'email' => 'sumaiya@example.com',
                'display_name' => 'Sumaiya',
                'gender' => 'bride',
                'age' => 24,
                'marital_status' => 'never_married',
                'city' => 'ঢাকা (মিরপুর)',
                'education' => 'অনার্স (ইংরেজি)',
                'occupation' => 'শিক্ষিকা',
                'about' => 'শালীন ও দ্বীনদার পাত্রী, তাহাজ্জুদ ও সালাতে যত্নশীল, অনার্স সম্পন্ন।',
                'published' => true,
            ],
            [
                'name' => 'Muhammad',
                'email' => 'muhammad@example.com',
                'display_name' => 'Muhammad',
                'gender' => 'groom',
                'age' => 30,
                'marital_status' => 'never_married',
                'city' => 'চট্টগ্রাম',
                'education' => 'এমবিএ (মার্কেটিং)',
                'occupation' => 'ব্যবসায়ী',
                'about' => 'হালাল ব্যবসার সাথে জড়িত, নিয়মিত জামায়াতে নামাজ পড়েন।',
                'published' => true,
            ],
            [
                'name' => 'Ayesha',
                'email' => 'ayesha@example.com',
                'display_name' => 'Ayesha',
                'gender' => 'bride',
                'age' => 22,
                'marital_status' => 'never_married',
                'city' => 'সিলেট',
                'education' => 'কুরআন হিফজ ও আলিম',
                'occupation' => 'গৃহিণী / ছাত্রী',
                'about' => 'পর্দানশীন পাত্রী, রাসুলুল্লাহর সুন্নাহ মানিয়া চলার মানসিকতা সম্পূর্ণ।',
                'published' => true,
            ],
            [
                'name' => 'Hafiz Mahmud',
                'email' => 'mahmud@example.com',
                'display_name' => 'Hafiz Mahmud',
                'gender' => 'groom',
                'age' => 29,
                'marital_status' => 'never_married',
                'city' => 'রাজশাহী',
                'education' => 'দাওরায়ে হাদিস ও বিএ',
                'occupation' => 'মাদ্রাসা শিক্ষক',
                'about' => 'আলেম ও হাফেজে কোরআন, সরল সুন্নতি দৃষ্টিভঙ্গির দ্বীনদার জীবনসঙ্গী।',
                'published' => true,
            ],
            [
                'name' => 'Fatima',
                'email' => 'fatima@example.com',
                'display_name' => 'Fatima',
                'gender' => 'bride',
                'age' => 26,
                'marital_status' => 'never_married',
                'city' => 'খুলনা',
                'education' => 'এমবিবিএস (MBBS)',
                'occupation' => 'ডাক্তার',
                'about' => 'ডাক্তার পাত্রী, নামাজ ও পর্দার নিয়ম মেনে চলার চেষ্টা করেন।',
                'published' => true,
            ],
            [
                'name' => 'Omar Faruk',
                'email' => 'omar@example.com',
                'display_name' => 'Omar Faruk',
                'gender' => 'groom',
                'age' => 27,
                'marital_status' => 'never_married',
                'city' => 'ময়মনসিংহ',
                'education' => 'বিবিএ (ফাইন্যান্স)',
                'occupation' => 'ব্যাংকার (ইসলামিক ব্যাংক)',
                'about' => 'ইসলামিক ব্যাংকে কর্মরত, সুন্নতি পোশাক ও দ্বীনি মেজাজ।',
                'published' => true,
            ],
            [
                'name' => 'Nusrat Jahan',
                'email' => 'nusrat@example.com',
                'display_name' => 'Nusrat Jahan',
                'gender' => 'bride',
                'age' => 23,
                'marital_status' => 'never_married',
                'city' => 'বরিশাল',
                'education' => 'এমএসসি (গণিত)',
                'occupation' => 'লেকচারার',
                'about' => 'শিক্ষিত ও ধার্মিক পাত্রী, পরিবারে ইসলামিক পরিবেশ বিদ্যমান।',
                'published' => true,
            ],
        ];

        foreach ($samples as $index => $sample) {
            $user = User::firstOrCreate(
                ['email' => $sample['email']],
                [
                    'name' => $sample['name'],
                    'password' => bcrypt('password'),
                ]
            );

            Biodata::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'display_name' => $sample['display_name'],
                    'gender' => $sample['gender'],
                    'age' => $sample['age'],
                    'marital_status' => $sample['marital_status'],
                    'city' => $sample['city'],
                    'education' => $sample['education'],
                    'occupation' => $sample['occupation'],
                    'about' => $sample['about'],
                    'published' => $sample['published'],
                ]
            );
        }
    }
}
