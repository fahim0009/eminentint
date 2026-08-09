<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records

        // --- 1. Create Categories ---
        $categories = [
            [
                'icon_class' => 'bi-tools', 'order' => 1,
                'en' => ['name' => 'Trade Testing & Evaluation'],
                'ar' => ['name' => 'اختبار المهارات والتقييم'],
                'bn' => ['name' => 'ট্রেড টেস্টিং এবং মূল্যায়ন'],
            ],
            [
                'icon_class' => 'bi-mortarboard-fill', 'order' => 2,
                'en' => ['name' => 'Pre-Departure Orientation'],
                'ar' => ['name' => 'التوجيه قبل المغادرة'],
                'bn' => ['name' => 'প্রস্থান-পূর্ববর্তী ওরিয়েন্টেশন'],
            ],
            [
                'icon_class' => 'bi-airplane-engines-fill', 'order' => 3,
                'en' => ['name' => 'Airport Flight Deployment'],
                'ar' => ['name' => 'نشر رحلات المطار'],
                'bn' => ['name' => 'বিমানবন্দর ফ্লাইট মোতায়েন'],
            ],
            [
                'icon_class' => 'bi-building-check', 'order' => 4,
                'en' => ['name' => 'KSA & Gulf Workplace'],
                'ar' => ['name' => 'بيئة العمل في السعودية والخليج'],
                'bn' => ['name' => 'কেএসএ এবং উপসাগরীয় কর্মক্ষেত্র'],
            ],
            [
                'icon_class' => 'bi-youtube', 'order' => 5,
                'en' => ['name' => 'Video Interviews'],
                'ar' => ['name' => 'مقابلات بالفيديو'],
                'bn' => ['name' => 'ভিডিও সাক্ষাৎকার'],
            ],
        ];

        $catIds = [];
        foreach ($categories as $catData) {
            $cat = GalleryCategory::create([
                'icon_class' => $catData['icon_class'],
                'slug' => Str::slug($catData['en']['name']),
                'order' => $catData['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $cat->translateOrNew($locale)->name = $catData[$locale]['name'];
            }
            $cat->save();
            
            $catIds[Str::slug($catData['en']['name'])] = $cat->id;
        }

        // --- 2. Create Gallery Items ---
        $items = [
            [
                'category_slug' => 'trade-testing-evaluation', 'type' => 'image', 
                'url' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800', 'location' => 'Dhaka, Bangladesh', 'date' => '2026-02-15', 'order' => 1,
                'en' => ['title' => 'Electrician Trade Test Evaluation', 'description' => 'Candidates undergoing practical electrical wiring and safety tests.'],
                'ar' => ['title' => 'تقييم اختبار مهارة الكهربائي', 'description' => 'المرشحون يخضعون لاختبارات عملية للأسلاك الكهربائية والسلامة.'],
                'bn' => ['title' => 'ইলেকট্রিশিয়ান ট্রেড টেস্ট মূল্যায়ন', 'description' => 'প্রার্থীরা ব্যবহারিক বৈদ্যুতিক ওয়্যারিং এবং সুরক্ষা পরীক্ষায় অংশ নিচ্ছে।'],
            ],
            [
                'category_slug' => 'trade-testing-evaluation', 'type' => 'image', 
                'url' => 'https://images.unsplash.com/photo-1565728744382-61accd4aa148?w=800', 'location' => 'Dhaka, Bangladesh', 'date' => '2026-02-10', 'order' => 2,
                'en' => ['title' => 'Welding Quality Inspection', 'description' => 'Final visual inspection of welded joints by certified engineers.'],
                'ar' => ['title' => 'فحص جودة اللحام', 'description' => 'الفحص البصري النهائي للمفاصل الملحومة بواسطة مهندسين معتمدين.'],
                'bn' => ['title' => 'ওয়েল্ডিং কোয়ালিটি ইন্সপেকশন', 'description' => 'সার্টিফায়েড ইঞ্জিনিয়ারদের দ্বারা ওয়েল্ডেড জয়েন্টগুলির চূড়ান্ত ভিজ্যুয়াল পরিদর্শন।'],
            ],
            [
                'category_slug' => 'pre-departure-orientation', 'type' => 'image', 
                'url' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=800', 'location' => 'BMET Office, Dhaka', 'date' => '2026-01-20', 'order' => 1,
                'en' => ['title' => 'BMET Orientation Session', 'description' => 'Mandatory government briefing for Saudi Arabia bound workers.'],
                'ar' => ['title' => 'جلسة التوجيه في BMET', 'description' => 'إحاطة حكومية إلزامية للعمال المتوجهين إلى المملكة العربية السعودية.'],
                'bn' => ['title' => 'বিএমইটি ওরিয়েন্টেশন সেশন', 'description' => 'সৌদি আরবগামী শ্রমিকদের জন্য বাধ্যতামূলক সরকারি ব্রিফিং।'],
            ],
            [
                'category_slug' => 'airport-flight-deployment', 'type' => 'image', 
                'url' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=800', 'location' => 'Hazrat Shahjalal Airport', 'date' => '2026-01-15', 'order' => 1,
                'en' => ['title' => 'Airport Farewell - Batch 45', 'description' => 'Final ticket processing and group photo before boarding flight SV-773.'],
                'ar' => ['title' => 'وداع المطار - الدفعة 45', 'description' => 'معالجة التذاكر النهائية وصورة جماعية قبل صعود الرحلة SV-773.'],
                'bn' => ['title' => 'বিমানবন্দর বিদায় - ব্যাচ ৪৫', 'description' => 'ফ্লাইট SV-773-এ ওঠার আগে চূড়ান্ত টিকিট প্রসেসিং এবং গ্রুপ ছবি।'],
            ],
            [
                'category_slug' => 'ksa-gulf-workplace', 'type' => 'youtube', 
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'location' => 'Riyadh, KSA', 'date' => '2026-01-05', 'order' => 1,
                'en' => ['title' => 'Worker Testimonial from Riyadh', 'description' => 'Success story of a Bangladeshi electrician working in Riyadh.'],
                'ar' => ['title' => 'شهادة عامل من الرياض', 'description' => 'قصة نجاح عامل كهربائي بنغلاديشي يعمل في الرياض.'],
                'bn' => ['title' => 'রিয়াদ থেকে শ্রমিকের সাক্ষাৎকার', 'description' => 'রিয়াদে কর্মরত একজন বাংলাদেশি ইলেকট্রিশিয়ানের সাফল্যের গল্প।'],
            ],
            [
                'category_slug' => 'video-interviews', 'type' => 'youtube', 
                'url' => 'https://www.youtube.com/watch?v=5qap5aO4i9A', 'location' => 'Dubai, UAE', 'date' => '2025-12-28', 'order' => 1,
                'en' => ['title' => 'Employer Interview - Dubai Hospitality', 'description' => 'Video interview with HR Manager of a luxury Dubai hotel.'],
                'ar' => ['title' => 'مقابلة صاحب العمل - ضيافة دبي', 'description' => 'مقابلة فيديو مع مدير الموارد البشرية في فندق فاخر في دبي.'],
                'bn' => ['title' => 'নিয়োগকর্তা সাক্ষাৎকার - দুবাই হসপিটালিটি', 'description' => 'দুবাইয়ের একটি বিলাসবহুল হোটেলের এইচআর ম্যানেজারের ভিডিও সাক্ষাৎকার।'],
            ],
        ];

        foreach ($items as $itemData) {
            $item = Gallery::create([
                'gallery_category_id' => $catIds[$itemData['category_slug']],
                'media_type' => $itemData['type'],
                'media_url' => $itemData['url'],
                'location' => $itemData['location'],
                'media_date' => $itemData['date'],
                'order' => $itemData['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $item->translateOrNew($locale)->title = $itemData[$locale]['title'];
                $item->translateOrNew($locale)->description = $itemData[$locale]['description'];
            }
            $item->save();
        }
    }
}