<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\HeroStat;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // HeroSection::truncate();
        // HeroStat::truncate();

        // --- 1. Seed Hero Section Content ---
        $hero = HeroSection::create([
            'image1' => null,
            'image2' => null,
            'image3' => null,
            'image4' => null,
            'badge1_icon' => 'bi bi-patch-check-fill',
            'badge2_icon' => 'bi bi-shield-lock-fill',
        ]);

        $heroTranslations = [
            'en' => [
                'title' => 'Your Gateway to<br>Global Workforce Solutions',
                'subtitle' => 'Connecting skilled talents from Bangladesh to leading employers in Saudi Arabia and worldwide.',
                'badge1_text' => 'Bangladesh Licensed Recruiting Agency',
                'badge2_text' => 'Saudi Arabia Licensed Service & Trading Company',
                'btn1_text' => 'Hire Workers',
                'btn2_text' => 'Explore Jobs',
                'btn3_text' => 'Application Tracker',
            ],
            'ar' => [
                'title' => 'بوابتك إلى<br>حلول القوى العاملة العالمية',
                'subtitle' => 'ربط المواهب الماهرة من بنغلاديش بأصحاب العمل الرائدين في المملكة العربية السعودية وحول العالم.',
                'badge1_text' => 'وكالة توظيف مرخصة في بنغلاديش',
                'badge2_text' => 'شركة خدمات وتجارة مرخصة في المملكة العربية السعودية',
                'btn1_text' => 'توظيف عمال',
                'btn2_text' => 'استكشاف الوظائف',
                'btn3_text' => 'تتبع الطلب',
            ],
            'bn' => [
                'title' => 'বিশ্বব্যাপী কর্মী সমাধানে<br>আপনার প্রবেশদ্বার',
                'subtitle' => 'বাংলাদেশের দক্ষ প্রতিভাকে সৌদি আরব এবং বিশ্বব্যাপী শীর্ষস্থানীয় নিয়োগকর্তাদের সাথে সংযুক্ত করা।',
                'badge1_text' => 'বাংলাদেশ লাইসেন্সপ্রাপ্ত নিয়োগ সংস্থা',
                'badge2_text' => 'সৌদি আরব লাইসেন্সপ্রাপ্ত সার্ভিস এবং ট্রেডিং কোম্পানি',
                'btn1_text' => 'শ্রমিক নিয়োগ করুন',
                'btn2_text' => 'কাজ খুঁজুন',
                'btn3_text' => 'আবেদন ট্র্যাকার',
            ]
        ];

        foreach (['en', 'ar', 'bn'] as $locale) {
            foreach ($heroTranslations[$locale] as $key => $value) {
                $hero->translateOrNew($locale)->$key = $value;
            }
        }
        $hero->save();


        // --- 2. Seed Hero Stats ---
        $stats = [
            [
                'icon' => 'bi bi-people-fill', 'icon_color' => 'text-navy', 'number' => '10000', 'suffix' => '+', 'order' => 1,
                'en' => ['label' => 'Workers Deployed'],
                'ar' => ['label' => 'عامل تم نشره'],
                'bn' => ['label' => 'কর্মী মোতায়েন'],
            ],
            [
                'icon' => 'bi bi-handshake-fill', 'icon_color' => 'text-navy', 'number' => '500', 'suffix' => '+', 'order' => 2,
                'en' => ['label' => 'Corporate Partners'],
                'ar' => ['label' => 'شركاء مؤسسيون'],
                'bn' => ['label' => 'কর্পোরেট পার্টনারস'],
            ],
            [
                'icon' => 'bi bi-globe2', 'icon_color' => 'text-navy', 'number' => '20', 'suffix' => '+', 'order' => 3,
                'en' => ['label' => 'Countries Served'],
                'ar' => ['label' => 'دول تم خدمتها'],
                'bn' => ['label' => 'পরিষেবা দেওয়া দেশসমূহ'],
            ],
            [
                'icon' => 'bi bi-briefcase-fill', 'icon_color' => 'text-navy', 'number' => '200', 'suffix' => '+', 'order' => 4,
                'en' => ['label' => 'Active Job Orders'],
                'ar' => ['label' => 'طلبات وظائف نشطة'],
                'bn' => ['label' => 'সক্রিয় কাজের অর্ডার'],
            ],
            [
                'icon' => 'bi bi-award-fill', 'icon_color' => 'text-gold', 'number' => '98', 'suffix' => '%', 'order' => 5,
                'en' => ['label' => 'Visa Success Rate'],
                'ar' => ['label' => 'معدل نجاح التأشيرة'],
                'bn' => ['label' => 'ভিসা সাফল্যের হার'],
            ],
        ];

        foreach ($stats as $statData) {
            $stat = HeroStat::create([
                'icon' => $statData['icon'],
                'icon_color' => $statData['icon_color'],
                'number' => $statData['number'],
                'suffix' => $statData['suffix'],
                'order' => $statData['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $stat->translateOrNew($locale)->label = $statData[$locale]['label'];
            }
            $stat->save();
        }
    }
}