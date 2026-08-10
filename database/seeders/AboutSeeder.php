<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Milestone;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // About::truncate();
        // Milestone::truncate();

        // --- 1. Seed About Page Content ---
        $about = About::create([
            'company_image' => null,
            'stat1_number' => '10,000+',
            'stat2_number' => '500+',
            'chairman_image' => null,
            'chairman_name' => 'Al-Haj Dr. Mohammad Rahman',
            'chairman_designation' => 'Chairman, Eminent Group',
            'ceo_image' => null,
            'ceo_name' => 'Engr. Kazi Muhammadullah',
            'ceo_designation' => 'Managing Director & CEO',
        ]);

        $translations = [
            'en' => [
                'hero_title' => 'About Eminent International',
                'hero_desc' => 'A trusted Bangladesh government-licensed recruiting agency (RL-1842) and licensed Saudi Arabia company (CR-1010778401) supplying skilled workforce worldwide.',
                'company_tag' => 'Our Company',
                'company_title' => 'Bridging Skilled Talent with Global Opportunities',
                'company_content1' => "Eminent International was established with a single vision: to transform international manpower recruitment into a seamless, transparent, and ethically compliant operation. Holding Recruiting License (RL-1842) from the Bangladesh Ministry of Expatriates' Welfare and Commercial Registration (CR-1010778401) in Saudi Arabia, we provide direct end-to-end recruitment services.",
                'company_content2' => "With dedicated corporate offices in Dhaka and Riyadh, our expert recruiters, trade testers, and legal officers ensure that every candidate is thoroughly vetted, medically tested, and pre-oriented before flight deployment.",
                'stat1_label' => 'Workers Deployed',
                'stat2_label' => 'Saudi & Global Clients',
                'mvv_tag' => 'Corporate Purpose',
                'mvv_title' => 'Our Mission & Vision',
                'vision_title' => 'Our Vision',
                'vision_content' => 'To become the premiere global workforce solutions partner recognized for ethical recruitment, speed, legal compliance, and candidate dignity across Saudi Arabia and international markets.',
                'mission_title' => 'Our Mission',
                'mission_content' => 'To connect premier corporate employers with trade-tested Bangladeshi talent, delivering fast deployment within 30-45 days while guaranteeing zero fraudulent fees for candidates.',
                'why_title' => 'Why Eminent?',
                'why_content' => '<ul><li>Dual Licensing (BD RL &amp; Saudi CR)</li><li>In-house Trade Testing Centers</li><li>Direct Saudi Embassy Visa Stamping</li><li>Post-Arrival Airport &amp; Onsite Support</li></ul>',
                'chairman_tag' => 'Leadership Insight',
                'chairman_title' => 'Message From The Chairman',
                'chairman_quote' => "Over the past decade, Eminent International has established itself as a beacon of trust and legal excellence in cross-border manpower recruitment. Our founding principle has always been to build genuine partnerships between employers in Saudi Arabia, Gulf, and Europe with hardworking professionals from Bangladesh. We remain committed to 100% legal compliance, zero candidate exploitation, and maximum client satisfaction.",
                'ceo_tag' => 'Operational Excellence',
                'ceo_title' => 'Message From The CEO',
                'ceo_quote' => "At Eminent International, we believe human capital is the true engine of national and corporate growth. Our promise to Saudi Arabian and global employers is simple: disciplined, trade-tested, and legally compliant workers delivered on schedule within 30-45 days. To our candidates, we offer a safe, transparent gateway to elevate their careers and family lives.",
                'timeline_tag' => 'Our Journey',
                'timeline_title' => 'Company Timeline (2021 - 2026)',
            ],
            'ar' => [
                'hero_title' => 'عن إميننت إنترناشونال',
                'hero_desc' => 'وكالة توظيف مرخصة من حكومة بنغلاديش (RL-1842) وشركة مرخصة في المملكة العربية السعودية (CR-1010778401) توفر القوى العاملة الماهرة في جميع أنحاء العالم.',
                'company_tag' => 'شركتنا',
                'company_title' => 'ربط المواهب الماهرة بالفرص العالمية',
                'company_content1' => "تأسست إميننت إنترناشونال برؤية واحدة: تحويل توظيف القوى العاملة الدولية إلى عملية سلسة وشفافة ومتوافقة مع الأخلاقيات. نحن نحمل رخصة التوظيف (RL-1842) من وزارة رعاية المغتربين في بنغلاديش والتسجيل التجاري (CR-1010778401) في المملكة العربية السعودية، مما يوفر خدمات توظيف مباشرة من البداية إلى النهاية.",
                'company_content2' => "مع مكاتبنا في دكا والرياض، يضمن خبراء التوظيف والمختبرون والمسؤولون القانونيون لدينا أن يتم فحص كل مرشح بدقة واختباره طبيًا وتوجيهه قبل نشر الرحلة.",
                'stat1_label' => 'عامل تم نشره',
                'stat2_label' => 'عملاء سعوديون وعالميون',
                'mvv_tag' => 'الغرض المؤسسي',
                'mvv_title' => 'مهمتنا ورؤيتنا',
                'vision_title' => 'رؤيتنا',
                'vision_content' => 'أن نصبح الشريك الأول لحلول القوى العاملة العالمية المعترف به للتوظيف الأخلاقي والسرعة والامتثال القانوني وكرامة المرشحين في المملكة العربية السعودية والأسواق الدولية.',
                'mission_title' => 'مهمتنا',
                'mission_content' => 'ربط أصحاب العمل المؤسسيين بالمواهب البنغلاديشية المختبرة، مما يوفر نشرًا سريعًا خلال 30-45 يومًا مع ضمان عدم وجود رسوم احتيالية للمرشحين.',
                'why_title' => 'لماذا إميننت؟',
                'why_content' => '<ul><li>الترخيص المزدوج (بنغلاديش والمملكة العربية السعودية)</li><li>مراكز اختبار المهارات الداخلية</li><li>ختم تأشيرة السفارة السعودية المباشرة</li><li>دعم المطار والموقع عند الوصول</li></ul>',
                'chairman_tag' => 'رؤية القيادة',
                'chairman_title' => 'رسالة من رئيس مجلس الإدارة',
                'chairman_quote' => "على مدى العقد الماضي، أثبتت إميننت إنترناشونال نفسها كمنارة للثقة والتميز القانوني في توظيف القوى العاملة عبر الحدود. كان مبدأنا التأسيسي دائمًا هو بناء شراكات حقيقية بين أصحاب العمل في المملكة العربية السعودية والخليج وأوروبا مع المحترفين المجتهدين من بنغلاديش.",
                'ceo_tag' => 'التميز التشغيلي',
                'ceo_title' => 'رسالة من الرئيس التنفيذي',
                'ceo_quote' => "في إميننت إنترناشونال، نؤمن بأن رأس المال البشري هو المحرك الحقيقي للنمو الوطني والمؤسسي. وعدنا لأصحاب العمل في المملكة العربية السعودية والعالم بسيط: عمال منضبطون ومختبرون ومتوافقون مع القوانين يتم تسليمهم في الموعد المحدد خلال 30-45 يومًا.",
                'timeline_tag' => 'رحلتنا',
                'timeline_title' => 'الجدول الزمني للشركة (2021 - 2026)',
            ],
            'bn' => [
                'hero_title' => 'এমিনেন্ট ইন্টারন্যাশনাল সম্পর্কে',
                'hero_desc' => 'বাংলাদেশ সরকার কর্তৃক লাইসেন্সপ্রাপ্ত নিয়োগ সংস্থা (RL-1842) এবং সৌদি আরবের লাইসেন্সপ্রাপ্ত কোম্পানি (CR-1010778401) যা বিশ্বব্যাপী দক্ষ কর্মী সরবরাহ করে।',
                'company_tag' => 'আমাদের কোম্পানি',
                'company_title' => 'দক্ষ প্রতিভাকে বিশ্বজনীন সুযোগের সাথে সংযুক্ত করা',
                'company_content1' => "এমিনেন্ট ইন্টারন্যাশনাল একটিমাত্র দৃষ্টিভঙ্গি নিয়ে প্রতিষ্ঠিত হয়েছিল: আন্তর্জাতিক ম্যানপাওয়ার নিয়োগকে একটি নিরবচ্ছিন্ন, স্বচ্ছ এবং নৈতিকভাবে সম্মত পরিচালনায় রূপান্তর করা। বাংলাদেশ প্রবাসী কল্যাণ মন্ত্রণালয় থেকে রিক্রুটিং লাইসেন্স (RL-1842) এবং সৌদি আরবে কমার্শিয়াল রেজিস্ট্রেশন (CR-1010778401) ধারণ করে, আমরা সরাসরি এন্ড-টু-এন্ড নিয়োগ পরিষেবা প্রদান করি।",
                'company_content2' => "ঢাকা এবং রিয়াদে আমাদের ডেডিকেটেড কর্পোরেট অফিস রয়েছে, আমাদের বিশেষজ্ঞ নিয়োগকারী, ট্রেড টেস্টার এবং আইনি কর্মকর্তারা নিশ্চিত করেন যে ফ্লাইট মোতায়েনের আগে প্রতিটি প্রার্থীকে সম্পূর্ণভাবে যাচাই করা হয়, চিকিৎসা পরীক্ষা করা হয় এবং পূর্ব-ওরিয়েন্টেড করা হয়।",
                'stat1_label' => 'কর্মী মোতায়েন',
                'stat2_label' => 'সৌদি ও বিশ্বব্যাপী ক্লায়েন্ট',
                'mvv_tag' => 'কর্পোরেট উদ্দেশ্য',
                'mvv_title' => 'আমাদের মিশন ও ভিশন',
                'vision_title' => 'আমাদের ভিশন',
                'vision_content' => 'নৈতিক নিয়োগ, গতি, আইনি সম্মতি এবং প্রার্থীর মর্যাদার জন্য স্বীকৃত প্রিমিয়ার গ্লোবাল ওয়ার্কফোর্স সলিউশন পার্টনার হওয়া।',
                'mission_title' => 'আমাদের মিশন',
                'mission_content' => 'প্রিমিয়ার কর্পোরেট নিয়োগকর্তাদের সাথে ট্রেড-টেস্টেড বাংলাদেশি প্রতিভাকে সংযুক্ত করা, ৩০-৪৫ দিনের মধ্যে দ্রুত মোতায়েন নিশ্চিত করা এবং প্রার্থীদের জন্য শূন্য প্রতারণামূলক ফি গ্যারান্টিযুক্ত করা।',
                'why_title' => 'কেন এমিনেন্ট?',
                'why_content' => '<ul><li>ডুয়াল লাইসেন্সিং (বিডি আরএল এবং সৌদি সিআর)</li><li>ইন-হাউস ট্রেড টেস্টিং সেন্টার</li><li>সরাসরি সৌদি দূতাবাস ভিসা স্ট্যাম্পিং</li><li>আগমনের পর বিমানবন্দর ও অনসাইট সাপোর্ট</li></ul>',
                'chairman_tag' => 'নেতৃত্বের অন্তর্দৃষ্টি',
                'chairman_title' => 'চেয়ারম্যানের বার্তা',
                'chairman_quote' => "গত এক দশকে, এমিনেন্ট ইন্টারন্যাশনাল ক্রস-বর্ডার ম্যানপাওয়ার নিয়োগে বিশ্বাস এবং আইনি উৎকর্ষের একটি দীপ্তিময় প্রতীক হিসেবে নিজেকে প্রতিষ্ঠিত করেছে। আমাদের প্রতিষ্ঠাতা নীতি সবসময় সৌদি আরব, উপসাগর এবং ইউরোপের নিয়োগকর্তাদের সাথে বাংলাদেশের পরিশ্রমী পেশাদারদের মধ্যে সত্যিকারের অংশীদারিত্ব গড়ে তোলা।",
                'ceo_tag' => 'পরিচালন উৎকর্ষ',
                'ceo_title' => 'সিইওর বার্তা',
                'ceo_quote' => "এমিনেন্ট ইন্টারন্যাশনালে, আমরা বিশ্বাস করি যে মানব পুঁজি হলো জাতীয় ও কর্পোরেট বৃদ্ধির প্রকৃত ইঞ্জিন। সৌদি আরব এবং বিশ্বব্যাপী নিয়োগকর্তাদের কাছে আমাদের প্রতিশ্রুতি সহজ: ৩০-৪৫ দিনের মধ্যে নির্ধারিত সময়সূচিতে সুশৃঙ্খল, ট্রেড-টেস্টেড এবং আইনি সম্মত শ্রমিক সরবরাহ করা।",
                'timeline_tag' => 'আমাদের যাত্রা',
                'timeline_title' => 'কোম্পানির টাইমলাইন (২০২১ - ২০২৬)',
            ]
        ];

        foreach (['en', 'ar', 'bn'] as $locale) {
            foreach ($translations[$locale] as $key => $value) {
                $about->translateOrNew($locale)->$key = $value;
            }
        }
        $about->save();


        // --- 2. Seed Milestones ---
        $milestones = [
            [
                'year' => '2021', 'badge_color' => 'bg-maroon', 'order' => 1,
                'en' => ['title' => 'Company Started', 'description' => 'Established in Dhaka with BMET recruiting license RL-1842.'],
                'ar' => ['title' => 'تأسست الشركة', 'description' => 'تأسست في داكا مع رخصة التوظيف BMET RL-1842.'],
                'bn' => ['title' => 'কোম্পানি শুরু হয়েছে', 'description' => 'বিএমইটি নিয়োগ লাইসেন্স RL-1842 সহ ঢাকায় প্রতিষ্ঠিত।'],
            ],
            [
                'year' => '2022', 'badge_color' => 'bg-navy', 'order' => 2,
                'en' => ['title' => 'Saudi Market Entry', 'description' => 'First bulk recruitment contracts signed for Saudi construction & hospitality.'],
                'ar' => ['title' => 'دخول السوق السعودي', 'description' => 'توقيع أول عقود توظيف جماعي للإنشاءات والضيافة في السعودية.'],
                'bn' => ['title' => 'সৌদি বাজারে প্রবেশ', 'description' => 'সৌদি নির্মাণ ও আতিথেয়তার জন্য প্রথম বাল্ক নিয়োগ চুক্তি স্বাক্ষরিত।'],
            ],
            [
                'year' => '2023', 'badge_color' => 'bg-gold', 'order' => 3,
                'en' => ['title' => 'Global Expansion', 'description' => 'Expanded deployment to UAE, Qatar, Oman, and Malaysia.'],
                'ar' => ['title' => 'التوسع العالمي', 'description' => 'توسيع النشر إلى الإمارات وقطر وعمان وماليزيا.'],
                'bn' => ['title' => 'বৈশ্বিক সম্প্রসারণ', 'description' => 'সংযুক্ত আরব আমিরাত, কাতার, ওমান এবং মালয়েশিয়ায় মোতায়েন প্রসারিত।'],
            ],
            [
                'year' => '2024', 'badge_color' => 'bg-navy', 'order' => 4,
                'en' => ['title' => 'B2B Alliances', 'description' => 'Over 300 corporate clients added across Gulf & European healthcare & logistics.'],
                'ar' => ['title' => 'تحالفات بين الشركات', 'description' => 'تمت إضافة أكثر من 300 عميل مؤسسي في دول الخليج والرعاية الصحية الأوروبية والخدمات اللوجستية.'],
                'bn' => ['title' => 'বিটুবি জোট', 'description' => 'উপসাগর ও ইউরোপীয় স্বাস্থ্যসেবা এবং লজিস্টিকস জুড়ে ৩০০+ কর্পোরেট ক্লায়েন্ট যুক্ত হয়েছে।'],
            ],
            [
                'year' => '2025', 'badge_color' => 'bg-maroon', 'order' => 5,
                'en' => ['title' => 'Saudi Office Established', 'description' => 'Opened full Riyadh branch on King Fahd Road for local client care.'],
                'ar' => ['title' => 'تأسيس المكتب السعودي', 'description' => 'افتتاح فرع كامل في الرياض على طريق الملك فهد لرعاية العملاء المحليين.'],
                'bn' => ['title' => 'সৌদি অফিস প্রতিষ্ঠা', 'description' => 'স্থানীয় ক্লায়েন্ট যত্নের জন্য কিং ফাহদ রোডে পূর্ণ রিয়াদ শাখা খোলা হয়েছে।'],
            ],
            [
                'year' => '2026', 'badge_color' => 'bg-success', 'order' => 6,
                'en' => ['title' => 'Saudi Licensed Company', 'description' => 'Obtained official Saudi CR and Trading License for direct staffing.'],
                'ar' => ['title' => 'شركة مرخصة في السعودية', 'description' => 'الحصول على السجل التجاري السعودي الرسمي ورخصة التجارة للتوظيف المباشر.'],
                'bn' => ['title' => 'সৌদি লাইসেন্সপ্রাপ্ত কোম্পানি', 'description' => 'সরাসরি কর্মী নিয়োগের জন্য অফিসিয়াল সৌদি CR এবং ট্রেডিং লাইসেন্স অর্জন।'],
            ],
        ];

        foreach ($milestones as $msData) {
            $ms = Milestone::create([
                'year' => $msData['year'],
                'badge_color' => $msData['badge_color'],
                'order' => $msData['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $ms->translateOrNew($locale)->title = $msData[$locale]['title'];
                $ms->translateOrNew($locale)->description = $msData[$locale]['description'];
            }
            $ms->save();
        }
    }
}