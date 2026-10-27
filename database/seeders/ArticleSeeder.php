<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'পাত্র/পাত্রী নির্বাচনে দ্বীনদারিতাকে কেন প্রাধান্য দেবেন?',
                'category' => 'সুন্নতি বিবাহ',
                'summary' => 'রাসূলুল্লাহ (সাল্লাল্লাহু আলাইহি ওয়া সাল্লাম) বলেছেন, নারীর চারটি বিষয় দেখে বিবাহ করা হয়...',
                'content' => 'রাসূলুল্লাহ (সাল্লাল্লাহু আলাইহি ওয়া সাল্লাম) বলেছেন, নারীর চারটি বিষয় দেখে বিবাহ করা হয়: তার ধন-সম্পদ, বংশমর্যাদা, সৌন্দর্য এবং তার দ্বীনদারিতা। তবে তুমি দ্বীনদার নারীকে বিবাহ করে সফলকাম হও, অন্যথায় তোমার হস্ত ধূলিমলিন হবে।',
                'image_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&q=80',
                'link_url' => route('guide'),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'অভিভাবক হিসেবে উপযুক্ত দ্বীনদার পাত্র চেনার উপায়',
                'category' => 'অভিভাবকের করণীয়',
                'summary' => 'মেয়ের অভিভাবক হিসেবে সন্তানের জীবনসঙ্গী বাছাইয়ের সময় কোন বিষয়গুলোতে বিশেষ নজর দেওয়া উচিত...',
                'content' => 'সন্তানের বিবাহে অভিভাবকের দায়িত্ব অপরিসীম। দ্বীনদার ও সৎ স্বভাবের পাত্র চেনার ক্ষেত্রে তার সালাত, আখলাক ও উপার্জন হালাল কিনা তা গভীরভাবে যাচাই করা উচিত।',
                'image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80',
                'link_url' => route('guide'),
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'ইসলামে বরকতময় সহজ মোহরানার গুরুত্ব ও বিধান',
                'category' => 'বিবাহের মোহর',
                'summary' => 'সবচেয়ে বরকতময় বিয়ে তা-ই যার মোহরানা সহজ ও সাধ্যের মধ্যে থাকে। জানা যাক শরীয়াহর দিকনির্দেশনা...',
                'content' => 'সহজ ও সাধ্যের মধ্যকার মোহরানা সুন্নাহ সম্মত। মোহরানা কোনো মূল্য নির্ধারণ নয়, বরং এটি স্ত্রীর প্রতি সম্মান ও দায়িত্বের প্রতীক।',
                'image_url' => 'https://images.unsplash.com/photo-1532622723896-12155799980d?auto=format&fit=crop&w=600&q=80',
                'link_url' => route('guide'),
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
