<?php

namespace Database\Seeders;

use App\Models\EmployerAdvantage;
use App\Models\RecruitmentStep;
use App\Models\TrackRecord;
use Illuminate\Database\Seeder;

class EmployerZoneSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // EmployerAdvantage::truncate();
        // RecruitmentStep::truncate();
        // TrackRecord::truncate();

        // --- 1. Employer Advantages (Why Choose Us) ---
        $advantages = [
            [
                'icon' => 'bi bi-shield-check', 'icon_color' => 'text-navy', 'order' => 1,
                'en' => ['title' => '100% Legal & Licensed', 'description' => 'Dual licensed in Bangladesh (RL-1842) and Saudi Arabia (CR-1010778401). Full government compliance guaranteed.'],
                'ar' => ['title' => 'مرخص قانوني 100%', 'description' => 'مرخص مزدوج في بنغلاديش (RL-1842) والمملكة العربية السعودية (CR-1010778401). ضمان الامتثال الحكومي الكامل.'],
                'bn' => ['title' => '১০০% আইনি এবং লাইসেন্সপ্রাপ্ত', 'description' => 'বাংলাদেশ (RL-1842) এবং সৌদি আরব (CR-1010778401) এ দ্বৈত লাইসেন্সপ্রাপ্ত। সম্পূর্ণ সরকারি সম্মতি নিশ্চিত।'],
            ],
            [
                'icon' => 'bi bi-speedometer2', 'icon_color' => 'text-gold', 'order' => 2,
                'en' => ['title' => 'Rapid Deployment', 'description' => 'Fast turnaround within 30 to 45 days from demand letter submission to worker arrival in Saudi Arabia.'],
                'ar' => ['title' => 'النشر السريع', 'description' => 'إنجاز سريع خلال 30 إلى 45 يومًا من تقديم خطاب الطلب إلى وصول العامل في المملكة العربية السعودية.'],
                'bn' => ['title' => 'দ্রুত মোতায়েন', 'description' => 'চাহিদাপত্র জমা দেওয়ার পর সৌদি আরবে কর্মী আসার জন্য ৩০ থেকে ৪৫ দিনের মধ্যে দ্রুত কাজ সম্পন্ন।'],
            ],
            [
                'icon' => 'bi bi-award-fill', 'icon_color' => 'text-maroon', 'order' => 3,
                'en' => ['title' => 'Trade Testing Center', 'description' => 'In-house technical training & evaluation institute ensuring 100% skill match for technical roles.'],
                'ar' => ['title' => 'مركز اختبار المهارات', 'description' => 'معهد تدريب وتقييم فني داخلي يضمن مطابقة المهارات بنسبة 100% للأدوار الفنية.'],
                'bn' => ['title' => 'ট্রেড টেস্টিং সেন্টার', 'description' => 'কারিগরি ভূমিকার জন্য ১০০% দক্ষতার মিল নিশ্চিত করে ইন-হাউস কারিগরি প্রশিক্ষণ ও মূল্যায়ন প্রতিষ্ঠান।'],
            ],
            [
                'icon' => 'bi bi-person-badge', 'icon_color' => 'text-success', 'order' => 4,
                'en' => ['title' => 'Dedicated Account Manager', 'description' => 'Local Saudi-based relationship managers in Riyadh to handle documentation, airport reception, and Iqama care.'],
                'ar' => ['title' => 'مدير حساب مخصص', 'description' => 'مديرو علاقات سعوديون محليون في الرياض للتعامل مع الوثائق واستقبال المطار ورعاية الإقامة.'],
                'bn' => ['title' => 'ডেডিকেটেড অ্যাকাউন্ট ম্যানেজার', 'description' => 'নথিপত্র পরিচালনা, বিমানবন্দর অভ্যর্থনা এবং ইকামা যত্নের জন্য রিয়াদে স্থানীয় সৌদি সম্পর্ক ব্যবস্থাপক।'],
            ],
        ];

        foreach ($advantages as $item) {
            $record = EmployerAdvantage::create([
                'icon' => $item['icon'], 'icon_color' => $item['icon_color'], 'order' => $item['order'], 'status' => 1,
            ]);
            foreach (['en', 'ar', 'bn'] as $locale) {
                $record->translateOrNew($locale)->title = $item[$locale]['title'];
                $record->translateOrNew($locale)->description = $item[$locale]['description'];
            }
            $record->save();
        }

        // --- 2. Recruitment Steps (8-Step Process) ---
        $steps = [
            ['badge_color' => 'bg-navy', 'border_color' => 'border-navy', 'order' => 1, 'badge_text' => 'Step 1', 'title' => 'Demand Requirement', 'desc' => 'Employer provides Demand Letter, Power of Attorney & Visa quota.'],
            ['badge_color' => 'bg-navy', 'border_color' => 'border-navy', 'order' => 2, 'badge_text' => 'Step 2', 'title' => 'Sourcing & Screening', 'desc' => 'Shortlisting candidates from our 10,000+ active Bangladesh database.'],
            ['badge_color' => 'bg-navy', 'border_color' => 'border-navy', 'order' => 3, 'badge_text' => 'Step 3', 'title' => 'Trade Testing', 'desc' => 'Practical skill testing conducted by certified engineers in Dhaka.'],
            ['badge_color' => 'bg-navy', 'border_color' => 'border-navy', 'order' => 4, 'badge_text' => 'Step 4', 'title' => 'Client Interview', 'desc' => 'Online video interview or in-person delegation visit to Dhaka.'],
            ['badge_color' => 'bg-gold', 'border_color' => 'border-gold', 'order' => 5, 'badge_text' => 'Step 5', 'title' => 'GAMCA Medical', 'desc' => 'Comprehensive GCC-approved medical examination & fitness report.'],
            ['badge_color' => 'bg-gold', 'border_color' => 'border-gold', 'order' => 6, 'badge_text' => 'Step 6', 'title' => 'Visa Stamping', 'desc' => 'Embassy passport submission via Enjaz MOFA portal.'],
            ['badge_color' => 'bg-gold', 'border_color' => 'border-gold', 'order' => 7, 'badge_text' => 'Step 7', 'title' => 'BMET Clearance', 'desc' => 'Government clearance card & pre-departure briefing.'],
            ['badge_color' => 'bg-success', 'border_color' => 'border-success', 'order' => 8, 'badge_text' => 'Step 8', 'title' => 'Deployment & Onsite', 'desc' => 'Flight departure & Saudi airport pickup to employer camp.'],
        ];

        // Translations for steps
        $stepTranslations = [
            'en' => $steps,
            'ar' => [
                ['badge_text' => 'الخطوة 1', 'title' => 'متطلبات الطلب', 'desc' => 'صاحب العمل يقدم خطاب الطلب والتوكيل الرسمي وحصة التأشيرة.'],
                ['badge_text' => 'الخطوة 2', 'title' => 'المصدر والفحص', 'desc' => 'إعداد قائمة مختصرة للمرشحين من قاعدة بيانات بنغلاديش النشطة التي تضم أكثر من 10000.'],
                ['badge_text' => 'الخطوة 3', 'title' => 'اختبار المهارات', 'desc' => 'اختبار المهارات العملية الذي يجريه مهندسون معتمدون في دكا.'],
                ['badge_text' => 'الخطوة 4', 'title' => 'مقابلة العميل', 'desc' => 'مقابلة بالفيديو عبر الإنترنت أو زيارة وفد شخصيًا إلى دكا.'],
                ['badge_text' => 'الخطوة 5', 'title' => 'فحص GAMCA الطبي', 'desc' => 'فحص طبي شامل معتمد من مجلس التعاون الخليجي وتقرير اللياقة البدنية.'],
                ['badge_text' => 'الخطوة 6', 'title' => 'ختم التأشيرة', 'desc' => 'تقديم جواز السفر للسفارة عبر بوابة إنجاز موفا.'],
                ['badge_text' => 'الخطوة 7', 'title' => 'تخليص BMET', 'desc' => 'بطاقة التخليص الحكومي وإحاطة قبل المغادرة.'],
                ['badge_text' => 'الخطوة 8', 'title' => 'النشر والموقع', 'desc' => 'مغادرة الرحلة واستقبال المطار السعودي إلى مخيم صاحب العمل.'],
            ],
            'bn' => [
                ['badge_text' => 'ধাপ ১', 'title' => 'চাহিদা প্রয়োজনীয়তা', 'desc' => 'নিয়োগকর্তা চাহিদাপত্র, পাওয়ার অফ অ্যাটর্নি এবং ভিসা কোটা প্রদান করেন।'],
                ['badge_text' => 'ধাপ ২', 'title' => 'সোর্সিং এবং স্ক্রিনিং', 'desc' => 'আমাদের ১০,০০০+ সক্রিয় বাংলাদেশ ডাটাবেস থেকে প্রার্থী নির্বাচন করা।'],
                ['badge_text' => 'ধাপ ৩', 'title' => 'ট্রেড টেস্টিং', 'desc' => 'ঢাকায় সার্টিফায়েড ইঞ্জিনিয়ারদের দ্বারা ব্যবহারিক দক্ষতা পরীক্ষা।'],
                ['badge_text' => 'ধাপ ৪', 'title' => 'ক্লায়েন্ট সাক্ষাৎকার', 'desc' => 'অনলাইন ভিডিও সাক্ষাৎকার বা ঢাকায় সশরীরে প্রতিনিধি দলের সাক্ষাৎকার।'],
                ['badge_text' => 'ধাপ ৫', 'title' => 'GAMCA মেডিকেল', 'desc' => 'জিসিসি-অনুমোদিত বিস্তৃত মেডিকেল পরীক্ষা এবং ফিটনেস রিপোর্ট।'],
                ['badge_text' => 'ধাপ ৬', 'title' => 'ভিসা স্ট্যাম্পিং', 'desc' => 'এনজাজ এমওএফএ পোর্টালের মাধ্যমে দূতাবাসে পাসপোর্ট জমা দেওয়া।'],
                ['badge_text' => 'ধাপ ৭', 'title' => 'বিএমইটি ছাড়পত্র', 'desc' => 'সরকারি ছাড়পত্র কার্ড এবং প্রস্থান-পূর্ববর্তী ব্রিফিং।'],
                ['badge_text' => 'ধাপ ৮', 'title' => 'মোতায়েন এবং অনসাইট', 'desc' => 'ফ্লাইট ছাড়া এবং নিয়োগকর্তা ক্যাম্পে সৌদি বিমানবন্দর থেকে পিকআপ।'],
            ]
        ];

        foreach ($steps as $index => $step) {
            $record = RecruitmentStep::create([
                'badge_color' => $step['badge_color'], 'border_color' => $step['border_color'], 'order' => $step['order'], 'status' => 1,
            ]);
            foreach (['en', 'ar', 'bn'] as $locale) {
                $record->translateOrNew($locale)->badge_text = $stepTranslations[$locale][$index]['badge_text'];
                $record->translateOrNew($locale)->title = $stepTranslations[$locale][$index]['title'];
                $record->translateOrNew($locale)->description = $stepTranslations[$locale][$index]['desc'];
            }
            $record->save();
        }

        // --- 3. Track Records (Partners) ---
        $records = [
            [
                'order' => 1,
                'en' => ['badge_text' => 'Confidential Partner — Riyadh', 'title' => 'Major Saudi Construction Company', 'description' => 'Supplied over 500+ Masons, Steel Fixers, Electricians, and Plumbers for commercial tower construction in Riyadh.', 'footer_text' => '✓ 500+ Workers Deployed'],
                'ar' => ['badge_text' => 'شريك سري — الرياض', 'title' => 'شركة سعودية كبرى للإنشاءات', 'description' => 'تزويد أكثر من 500+ بناء ومثبت فولاد وكهربائيين وسباكين لبناء الأبراج التجارية في الرياض.', 'footer_text' => '✓ تم نشر 500+ عامل'],
                'bn' => ['badge_text' => 'গোপন অংশীদার — রিয়াদ', 'title' => 'বড় সৌদি নির্মাণ কোম্পানি', 'description' => 'রিয়াদে বাণিজ্যিক টাওয়ার নির্মাণের জন্য ৫০০+ রাজমিস্ত্রি, স্টিল ফিক্সার, ইলেকট্রিশিয়ান এবং প্লাম্বার সরবরাহ করা হয়েছে।', 'footer_text' => '✓ 500+ কর্মী মোতায়েন করা হয়েছে'],
            ],
            [
                'order' => 2,
                'en' => ['badge_text' => 'Confidential Partner — Jeddah', 'title' => 'Saudi Restaurant & Catering Group', 'description' => 'Provided 200+ Baristas, Waiters, Chefs, and Kitchen Helpers for luxury dining chains in Jeddah & Mecca.', 'footer_text' => '✓ 200+ Staff Deployed'],
                'ar' => ['badge_text' => 'شريك سري — جدة', 'title' => 'مجموعة مطاعم وتموين السعودية', 'description' => 'توفير 200+ باريستا ونوادل وطهاة ومساعدي مطبخ لسلاسل تناول الطعام الفاخرة في جدة ومكة.', 'footer_text' => '✓ تم نشر 200+ موظف'],
                'bn' => ['badge_text' => 'গোপন অংশীদার — জেদ্দা', 'title' => 'সৌদি রেস্তোরাঁ ও ক্যাটারিং গ্রুপ', 'description' => 'জেদ্দা ও মক্কায় বিলাসবহুল ডাইনিং চেইনের জন্য ২০০+ বারিস্টা, ওয়েটার, বাবুর্চি এবং রান্নাঘরের সহকারী সরবরাহ করা হয়েছে।', 'footer_text' => '✓ 200+ কর্মী মোতায়েন করা হয়েছে'],
            ],
            [
                'order' => 3,
                'en' => ['badge_text' => 'Confidential Partner — Dammam', 'title' => 'Facility Management & Cleaning Co.', 'description' => 'Deployed 350+ General Cleaners and Housekeeping Supervisors for government facilities.', 'footer_text' => '✓ 350+ Cleaners Deployed'],
                'ar' => ['badge_text' => 'شريك سري — الدمام', 'title' => 'شركة إدارة المرافق والتنظيف', 'description' => 'نشر 350+ عامل نظافة عامة ومشرفين على التدبير المنزلي للمرافق الحكومية.', 'footer_text' => '✓ تم نشر 350+ عامل نظافة'],
                'bn' => ['badge_text' => 'গোপন অংশীদার — দাম্মাম', 'title' => 'ফ্যাসিলিটি ম্যানেজমেন্ট ও ক্লিনিং কোং', 'description' => 'সরকারি সুবিধার জন্য ৩৫০+ সাধারণ পরিচ্ছদক এবং হাউসকিপিং সুপারভাইজার মোতায়েন করা হয়েছে।', 'footer_text' => '✓ 350+ ক্লিনার মোতায়েন করা হয়েছে'],
            ],
        ];

        foreach ($records as $item) {
            $record = TrackRecord::create(['order' => $item['order'], 'status' => 1]);
            foreach (['en', 'ar', 'bn'] as $locale) {
                $record->translateOrNew($locale)->badge_text = $item[$locale]['badge_text'];
                $record->translateOrNew($locale)->title = $item[$locale]['title'];
                $record->translateOrNew($locale)->description = $item[$locale]['description'];
                $record->translateOrNew($locale)->footer_text = $item[$locale]['footer_text'];
            }
            $record->save();
        }
    }
}