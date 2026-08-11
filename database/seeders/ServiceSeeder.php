<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // Service::truncate();

        $services = [
            [
                'icon' => 'bi bi-person-fill-check', 'icon_color' => 'text-navy', 'anchor_id' => 'permanent', 'order' => 1,
                'en' => [
                    'title' => 'Permanent Recruitment',
                    'description' => 'Long-term staffing solution for corporate, medical, hospitality, and engineering organizations seeking vetted professional personnel.',
                    'features' => '<ul><li>Detailed candidate background check</li><li>Degree & license document verification</li><li>Comprehensive 3-month probation warranty</li></ul>'
                ],
                'ar' => [
                    'title' => 'التوظيف الدائم',
                    'description' => 'حلول توظيف طويلة الأمد للشركات الطبية والضيافة والهندسية التي تبحث عن موظفين محترفين تم التحقق منهم.',
                    'features' => '<ul><li>فحص مفصل لخلفية المرشح</li><li>التحقق من وثائق الدرجات والتراخيص</li><li>ضمان فترة تجريبية شاملة لمدة 3 أشهر</li></ul>'
                ],
                'bn' => [
                    'title' => 'স্থায়ী নিয়োগ',
                    'description' => 'কর্পোরেট, চিকিৎসা, আতিথেয়তা এবং প্রকৌশল সংস্থাগুলির জন্য দীর্ঘমেয়াদী কর্মী নিয়োগ সমাধান যারা যাচাইকৃত পেশাদার কর্মী খুঁজছে।',
                    'features' => '<ul><li>প্রার্থীর ব্যাকগ্রাউন্ড বিস্তারিত যাচাই</li><li>ডিগ্রী এবং লাইসেন্স নথি যাচাইকরণ</li><li>৩ মাসের সম্পূর্ণ পরিমেলকালীন ওয়ারেন্টি</li></ul>'
                ],
            ],
            [
                'icon' => 'bi bi-people-fill', 'icon_color' => 'text-gold', 'anchor_id' => 'bulk', 'order' => 2,
                'en' => [
                    'title' => 'Bulk Workforce Supply',
                    'description' => 'Specialized deployment of 50 to 1,000+ workers for mega construction projects, facility management, and logistics hubs.',
                    'features' => '<ul><li>Fast-track 30 to 45 days deployment timeline</li><li>Dedicated on-site coordinator in KSA</li><li>Complete visa stamping & BMET clearance</li></ul>'
                ],
                'ar' => [
                    'title' => 'توريد القوى العاملة بالجملة',
                    'description' => 'نشر متخصص لـ 50 إلى 1000+ عامل لمشاريع البناء الضخمة وإدارة المرافق ومراكز الخدمات اللوجستية.',
                    'features' => '<ul><li>جدول نشر سريع المسار من 30 إلى 45 يومًا</li><li>منسق مخصص في الموقع في المملكة العربية السعودية</li><li>ختم التأشيرة الكامل وموافقة BMET</li></ul>'
                ],
                'bn' => [
                    'title' => 'বাল্ক কর্মী সরবরাহ',
                    'description' => 'মেগা নির্মাণ প্রকল্প, সুবিধা ব্যবস্থাপনা এবং লজিস্টিকস হাবের জন্য ৫০ থেকে ১,০০০+ শ্রমিকের বিশেষ মোতায়েন।',
                    'features' => '<ul><li>৩০ থেকে ৪৫ দিনের ফাস্ট-ট্র্যাক মোতায়েন সময়সূচী</li><li>কেএসএ-তে ডেডিকেটেড অন-সাইট কো-অর্ডিনেটর</li><li>সম্পূর্ণ ভিসা স্ট্যাম্পিং এবং বিএমইটি ছাড়পত্র</li></ul>'
                ],
            ],
            [
                'icon' => 'bi bi-tools', 'icon_color' => 'text-maroon', 'anchor_id' => 'trade', 'order' => 3,
                'en' => [
                    'title' => 'Trade Testing & Vetting',
                    'description' => 'Rigorous practical trade testing at our technical institute in Dhaka for electricians, plumbers, welders, baristas, and mechanics.',
                    'features' => '<ul><li>ISO-certified testing center</li><li>Video recorded interview option</li><li>Live employer online trade test access</li></ul>'
                ],
                'ar' => [
                    'title' => 'اختبار المهارات والفحص',
                    'description' => 'اختبار عملي صارم في معهدنا التقني في دكا للكهربائيين والسباكين واللحامين والباريستا والميكانيكيين.',
                    'features' => '<ul><li>مركز اختبار معتمد من ISO</li><li>خيار مقابلة مسجلة بالفيديو</li><li>وصول صاحب العمل المباشر للاختبار عبر الإنترنت</li></ul>'
                ],
                'bn' => [
                    'title' => 'ট্রেড টেস্টিং এবং যাচাই',
                    'description' => 'ঢাকায় আমাদের কারিগরি প্রতিষ্ঠানে ইলেকট্রিশিয়ান, প্লাম্বার, ওয়েল্ডার, বারিস্টা এবং মেকানিকদের জন্য কঠোর ব্যবহারিক পরীক্ষা।',
                    'features' => '<ul><li>আইএসও-সার্টিফায়েড টেস্টিং সেন্টার</li><li>ভিডিও রেকর্ড করা সাক্ষাৎকারের বিকল্প</li><li>নিয়োগকর্তার জন্য লাইভ অনলাইন ট্রেড টেস্ট অ্যাক্সেস</li></ul>'
                ],
            ],
            [
                'icon' => 'bi bi-passport-fill', 'icon_color' => 'text-navy', 'anchor_id' => 'visa', 'order' => 4,
                'en' => [
                    'title' => 'Visa Processing & Legal Compliance',
                    'description' => 'Direct embassy visa endorsement with Saudi Ministry of Foreign Affairs (MOFA), Enjaz system, and BMET Smart Card issuance.',
                    'features' => '<ul><li>GAMCA medical test clearance</li><li>Police verification & clearance</li><li>100% legal government clearance</li></ul>'
                ],
                'ar' => [
                    'title' => 'معالجة التأشيرة والامتثال القانوني',
                    'description' => 'تأشيرة السفارة المباشرة مع وزارة الخارجية السعودية (موفا) ونظام إنجاز وإصدار البطاقة الذكية لـ BMET.',
                    'features' => '<ul><li>مخاطرصة الفحص الطبي GAMCA</li><li>التحقق من الشرطة والتخليص</li><li>100% تخليص حكومي قانوني</li></ul>'
                ],
                'bn' => [
                    'title' => 'ভিসা প্রসেসিং এবং আইনি সম্মতি',
                    'description' => 'সৌদি পররাষ্ট্র মন্ত্রণালয় (MOFA), এনজাজ সিস্টেম এবং বিএমইটি স্মার্ট কার্ড জারির মাধ্যমে সরাসরি দূতাবাস ভিসা অনুমোদন।',
                    'features' => '<ul><li>GAMCA মেডিকেল টেস্ট ছাড়পত্র</li><li>পুলিশ যাচাই এবং ছাড়পত্র</li><li>১০০% আইনি সরকারি ছাড়পত্র</li></ul>'
                ],
            ],
            [
                'icon' => 'bi bi-headset', 'icon_color' => 'text-gold', 'anchor_id' => null, 'order' => 5,
                'en' => [
                    'title' => 'Orientation & Soft Skills',
                    'description' => 'Mandatory 3-day orientation training covering local laws, Arabic language basics, safety, and cultural etiquette before flight departure.',
                    'features' => '<ul><li>Workplace safety & PPE usage</li><li>Basic conversational Arabic / English</li><li>Flight & airport guidance</li></ul>'
                ],
                'ar' => [
                    'title' => 'التوجيه والمهارات الناعمة',
                    'description' => 'تدريب توجيهي إلزامي لمدة 3 أيام يغطي القوانين المحلية وأساسيات اللغة العربية والسلامة والآداب الثقافية قبل مغادرة الرحلة.',
                    'features' => '<ul><li>سلامة مكان العمل واستخدام معدات الوقاية</li><li>محادثة أساسية باللغة العربية / الإنجليزية</li><li>إرشاد الرحلات والمطار</li></ul>'
                ],
                'bn' => [
                    'title' => 'ওরিয়েন্টেশন এবং সফট স্কিল',
                    'description' => 'ফ্লাইট ছাড়ার আগে স্থানীয় আইন, আরবি ভাষার প্রাথমিক বিষয়, নিরাপত্তা এবং সাংস্কৃতিক শিষ্টাচার সম্পর্কে ৩ দিনের বাধ্যতামূলক ওরিয়েন্টেশন প্রশিক্ষণ।',
                    'features' => '<ul><li>কর্মক্ষেত্রের নিরাপত্তা এবং পিপিই ব্যবহার</li><li>প্রাথমিক আরবি / ইংরেজি কথোপকথন</li><li>ফ্লাইট এবং বিমানবন্দর গাইডলাইন</li></ul>'
                ],
            ],
            [
                'icon' => 'bi bi-airplane-fill', 'icon_color' => 'text-maroon', 'anchor_id' => null, 'order' => 6,
                'en' => [
                    'title' => 'Deployment & Post-Arrival',
                    'description' => 'Airport reception in Riyadh, Jeddah, Dammam, Dubai, or Muscat. We accompany workers directly to employer accommodations.',
                    'features' => '<ul><li>Airport pickup & transport to camp</li><li>Iqama & medical insurance support</li><li>Continuous 24/7 worker welfare care</li></ul>'
                ],
                'ar' => [
                    'title' => 'النشر وما بعد الوصول',
                    'description' => 'استقبال في المطار في الرياض أو جدة أو الدمام أو دبي أو مسقط. نرافق العمال مباشرة إلى أماكن إقامة صاحب العمل.',
                    'features' => '<ul><liالاستقبال في المطار والنقل إلى المخيم</li><li>دعم الإقامة والتأمين الطبي</li><li>رعاية مستمرة لرفاهية العمال على مدار الساعة</li></ul>'
                ],
                'bn' => [
                    'title' => 'মোতায়েন এবং আগমন-পরবর্তী',
                    'description' => 'রিয়াদ, জেদ্দা, দাম্মাম, দুবাই বা মাস্কাটে বিমানবন্দর অভ্যর্থনা। আমরা কর্মীদের সরাসরি নিয়োগকর্তার আবাসনে নিয়ে যাই।',
                    'features' => '<ul><li>বিমানবন্দর পিকআপ এবং ক্যাম্পে পরিবহন</li><li>ইকামা এবং মেডিকেল ইন্স্যুরেন্স সহায়তা</li><li>২৪/৭ নিরবচ্ছিন্ন কর্মী কল্যাণ যত্ন</li></ul>'
                ],
            ],
        ];

        foreach ($services as $item) {
            $service = Service::create([
                'icon' => $item['icon'],
                'icon_color' => $item['icon_color'],
                'anchor_id' => $item['anchor_id'],
                'order' => $item['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $service->translateOrNew($locale)->title = $item[$locale]['title'];
                $service->translateOrNew($locale)->description = $item[$locale]['description'];
                $service->translateOrNew($locale)->features = $item[$locale]['features'];
            }
            $service->save();
        }
    }
}