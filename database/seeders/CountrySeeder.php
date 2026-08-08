<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // Country::truncate();

        $countries = [
            [
                'flag' => '🇸🇦', 'salary_range' => '1,500 - 4,500 SAR', 'deployment_time' => '30 - 40 Days', 
                'is_featured' => 1, 'order' => 1, 'image' => null,
                'en' => ['name' => 'Saudi Arabia', 'short_name' => 'KSA', 'description' => 'As a Saudi Arabia Licensed Company (CR: 1010778401) with our headquarters on King Fahd Road in Riyadh, Eminent International is the premier supplier of skilled and semi-skilled labor across Riyadh, Jeddah, Dammam, Neom, and Medina.', 'current_demand' => '500+ Openings', 'visa_process' => 'MOFA / Enjaz Direct', 'job_link' => 'jobs.html?country=saudi'],
                'ar' => ['name' => 'المملكة العربية السعودية', 'short_name' => 'KSA', 'description' => 'بصفتنا شركة مرخصة في المملكة العربية السعودية (س.ت: 1010778401) ومقرنا الرئيسي في طريق الملك فهد بالرياض، تعتبر إميننت إنترناشونال المورد الأول للعمالة المهنية وشبه الماهرة في الرياض وجدة والدمام ونيوم والمدينة المنورة.', 'current_demand' => '500+ وظيفة شاغرة', 'visa_process' => 'موفا / إنجاز مباشر', 'job_link' => 'jobs.html?country=saudi'],
                'bn' => ['name' => 'সৌদি আরব', 'short_name' => 'KSA', 'description' => 'সৌদি আরবের লাইসেন্সপ্রাপ্ত কোম্পানি (CR: 1010778401) হিসেবে রিয়াদের কিং ফাহদ রোডে আমাদের সদর দপ্তর রয়েছে, এমিনেন্ট ইন্টারন্যাশনাল রিয়াদ, জেদ্দা, দাম্মাম, নিওম এবং মদিনায় দক্ষ ও অর্ধ-দক্ষ শ্রমিক সরবরাহের প্রধান সরবরাহকারী।', 'current_demand' => '৫০০+ শূন্যপদ', 'visa_process' => 'MOFA / Enjaz Direct', 'job_link' => 'jobs.html?country=saudi'],
            ],
            [
                'flag' => '🇦🇪', 'salary_range' => '1,200 - 3,500 AED', 'deployment_time' => '25 - 35 Days', 
                'is_featured' => 0, 'order' => 2, 'image' => null,
                'en' => ['name' => 'United Arab Emirates', 'short_name' => 'UAE', 'description' => 'Supplying hospitality staff, construction labor, facility cleaners, and delivery drivers for Dubai, Abu Dhabi, and Sharjah.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=uae'],
                'ar' => ['name' => 'الإمارات العربية المتحدة', 'short_name' => 'UAE', 'description' => 'توريد موظفي ضيافة وعمال بناء وعمال نظافة مرافق وسائقي توصيل لدبي وأبو ظبي والشارقة.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=uae'],
                'bn' => ['name' => 'সংযুক্ত আরব আমিরাত', 'short_name' => 'UAE', 'description' => 'দুবাই, আবুধাবি এবং শারজাহর জন্য আতিথেয়তা কর্মী, নির্মাণ শ্রমিক, সুবিধা পরিচ্ছদক এবং ডেলিভারি ড্রাইভার সরবরাহ করা হচ্ছে।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=uae'],
            ],
            [
                'flag' => '🇶🇦', 'salary_range' => '1,400 - 3,800 QAR', 'deployment_time' => '30 Days', 
                'is_featured' => 0, 'order' => 3, 'image' => null,
                'en' => ['name' => 'Qatar', 'short_name' => 'QA', 'description' => 'Supplying skilled MEP technicians, airport loaders, restaurant waiters, and security guards in Doha.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=qatar'],
                'ar' => ['name' => 'قطر', 'short_name' => 'QA', 'description' => 'توريد فنيي MEP المهرة وعمال تحميل المطار ونوادي المطاعم وحراس الأمن في الدوحة.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=qatar'],
                'bn' => ['name' => 'কাতার', 'short_name' => 'QA', 'description' => 'দোহায় দক্ষ এমইপি টেকনিশিয়ান, বিমানবন্দর লোডার, রেস্তোরাঁ ওয়েটার এবং নিরাপত্তা প্রহরী সরবরাহ করা হচ্ছে।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=qatar'],
            ],
            [
                'flag' => '🇴🇲', 'salary_range' => '120 - 280 OMR', 'deployment_time' => '30 Days', 
                'is_featured' => 0, 'order' => 4, 'image' => null,
                'en' => ['name' => 'Oman', 'short_name' => 'OM', 'description' => 'Recruiting agriculture workers, tailors, construction masons, and warehouse staff in Muscat and Salalah.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=oman'],
                'ar' => ['name' => 'عمان', 'short_name' => 'OM', 'description' => 'توظيف عمال الزراعة والخياطين وعمال البناء وعمال المستودعات في مسقط وصلالة.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=oman'],
                'bn' => ['name' => 'ওমান', 'short_name' => 'OM', 'description' => 'মাস্কাট এবং সালালাহতে কৃষি শ্রমিক, দর্জি, নির্মাণ রাজমিস্ত্রি এবং গুদাম কর্মী নিয়োগ করা হচ্ছে।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=oman'],
            ],
            [
                'flag' => '🇲🇹', 'salary_range' => '900 - 1,400 EUR', 'deployment_time' => '60 - 90 Days', 
                'is_featured' => 0, 'order' => 5, 'image' => null,
                'en' => ['name' => 'Malta (European Union)', 'short_name' => 'MT', 'description' => 'EU Work Permit recruitment for hotel staff, airport loaders, bus drivers, and factory operators in Malta.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=malta'],
                'ar' => ['name' => 'مالطا (الاتحاد الأوروبي)', 'short_name' => 'MT', 'description' => 'توظيف تصريح عمل في الاتحاد الأوروبي لموظفي الفنادق وعمال تحميل المطار وسائقي الحافلات وعمال المصانع في مالطا.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=malta'],
                'bn' => ['name' => 'মাল্টা (ইউরোপীয় ইউনিয়ন)', 'short_name' => 'MT', 'description' => 'মাল্টায় হোটেল কর্মী, বিমানবন্দর লোডার, বাস ড্রাইভার এবং কারখানার অপারেটরদের জন্য ইইউ ওয়ার্ক পারমিট নিয়োগ।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=malta'],
            ],
            [
                'flag' => '🇭🇺', 'salary_range' => '750 - 1,100 EUR', 'deployment_time' => '60 - 90 Days', 
                'is_featured' => 0, 'order' => 6, 'image' => null,
                'en' => ['name' => 'Hungary (European Union)', 'short_name' => 'HU', 'description' => 'Manufacturing assemblers, logistics packers, and agricultural greenhouse workers in Budapest.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=hungary'],
                'ar' => ['name' => 'المجر (الاتحاد الأوروبي)', 'short_name' => 'HU', 'description' => 'عاملو تجميع التصنيع وعمال تغليف اللوجستيات وعمال البيوت الزجاجية الزراعية في بودابست.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=hungary'],
                'bn' => ['name' => 'হাঙ্গেরি (ইউরোপীয় ইউনিয়ন)', 'short_name' => 'HU', 'description' => 'বুদাপেস্টে উৎপাদন অ্যাসেম্বলার, লজিস্টিকস প্যাকার এবং কৃষি গ্রিনহাউস কর্মী।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=hungary'],
            ],
            [
                'flag' => '🇵🇱', 'salary_range' => '850 - 1,300 EUR', 'deployment_time' => '60 - 90 Days', 
                'is_featured' => 0, 'order' => 7, 'image' => null,
                'en' => ['name' => 'Poland (European Union)', 'short_name' => 'PL', 'description' => 'Forklift drivers, meat processing workers, and construction welders across Warsaw and Krakow.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=poland'],
                'ar' => ['name' => 'بولندا (الاتحاد الأوروبي)', 'short_name' => 'PL', 'description' => 'سائقو الرافعات الشوكية وعمال معالجة اللحوم ولحامون للإنشاءات في جميع أنحاء وارسو وكراكوف.', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=poland'],
                'bn' => ['name' => 'পোল্যান্ড (ইউরোপীয় ইউনিয়ন)', 'short_name' => 'PL', 'description' => 'ওয়ারশ এবং ক্রাকো জুড়ে ফোর্কলিফট ড্রাইভার, মাংস প্রক্রিয়াজাতকরণ শ্রমিক এবং নির্মাণ ওয়েল্ডার।', 'current_demand' => null, 'visa_process' => null, 'job_link' => 'jobs.html?country=poland'],
            ],
        ];

        foreach ($countries as $countryData) {
            $country = Country::create([
                'flag' => $countryData['flag'],
                'salary_range' => $countryData['salary_range'],
                'deployment_time' => $countryData['deployment_time'],
                'is_featured' => $countryData['is_featured'],
                'order' => $countryData['order'],
                'image' => $countryData['image'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $country->translateOrNew($locale)->name = $countryData[$locale]['name'];
                $country->translateOrNew($locale)->short_name = $countryData[$locale]['short_name'];
                $country->translateOrNew($locale)->description = $countryData[$locale]['description'];
                $country->translateOrNew($locale)->current_demand = $countryData[$locale]['current_demand'];
                $country->translateOrNew($locale)->visa_process = $countryData[$locale]['visa_process'];
                $country->translateOrNew($locale)->job_link = $countryData[$locale]['job_link'];
            }

            $country->save();
        }
    }
}