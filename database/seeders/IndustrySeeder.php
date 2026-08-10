<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // Industry::truncate();

        $industries = [
            [
                'icon' => 'bi bi-building', 'icon_color' => 'text-navy', 'order' => 1,
                'en' => ['title' => 'Construction & Engineering', 'description' => 'Electricians, Plumbers, Masons, Carpenters, Welders, Steel Fixers, Scaffolders, Heavy Equipment Operators.', 'button_text' => 'Request Construction Staff'],
                'ar' => ['title' => 'البناء والهندسة', 'description' => 'كهربائيون، سباكون، بناءون، نجارون، لحامون، تثبيت الفولاذ، عمال السقالات، مشغلو المعدات الثقيلة.', 'button_text' => 'طلب موظفي البناء'],
                'bn' => ['title' => 'নির্মাণ ও প্রকৌশল', 'description' => 'ইলেকট্রিশিয়ান, প্লাম্বার, মিস্ত্রি, ছুতার, ওয়েল্ডার, স্টিল ফিক্সার, স্কাফোল্ডার, ভারী যন্ত্রপাতি পরিচালক।', 'button_text' => 'নির্মাণ কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-cup-hot', 'icon_color' => 'text-gold', 'order' => 2,
                'en' => ['title' => 'Hospitality & Catering', 'description' => 'Executive Chefs, Line Cooks, Baristas, Restaurant Waiters, Kitchen Stewards, Hotel Room Attendants.', 'button_text' => 'Request Hospitality Staff'],
                'ar' => ['title' => 'الضيافة والتموين', 'description' => 'طهاة تنفيذيون، طهاة الخط، باريستا، نوادل المطاعم، مضيفو المطبخ، مضيفو غرف الفندق.', 'button_text' => 'طلب موظفي الضيافة'],
                'bn' => ['title' => 'আতিথেয়তা ও ক্যাটারিং', 'description' => 'নির্বাহী বাবুর্চি, লাইন কুক, বারিস্টা, রেস্তোরাঁ ওয়েটার, রান্নাঘরের স্টুয়ার্ড, হোটেল রুম অ্যাটেনড্যান্ট।', 'button_text' => 'আতিথেয়তা কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-truck', 'icon_color' => 'text-maroon', 'order' => 3,
                'en' => ['title' => 'Logistics & Warehousing', 'description' => 'Forklift Drivers, Heavy Truck Drivers, Delivery Riders, Inventory Packers, Warehouse Supervisors.', 'button_text' => 'Request Logistics Staff'],
                'ar' => ['title' => 'الخدمات اللوجستية والتخزين', 'description' => 'سائقو الرافعات الشوكية، سائقو الشاحنات الثقيلة، راكبو التوصيل، نجارو المخزون، مشرفو المستودعات.', 'button_text' => 'طلب موظفي الخدمات اللوجستية'],
                'bn' => ['title' => 'লজিস্টিকস এবং ওয়্যারহাউজিং', 'description' => 'ফোর্কলিফট ড্রাইভার, ভারী ট্রাক ড্রাইভার, ডেলিভারি রাইডার, ইনভেন্টরি প্যাকার, ওয়্যারহাউস সুপারভাইজার।', 'button_text' => 'লজিস্টিকস কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-tools', 'icon_color' => 'text-success', 'order' => 4,
                'en' => ['title' => 'Facility Management', 'description' => 'General Cleaners, HVAC Technicians, Electricians, Security Guards, Housekeeping Supervisors.', 'button_text' => 'Request Facility Staff'],
                'ar' => ['title' => 'إدارة المرافق', 'description' => 'عاملو نظافة عامون، فنيو التكييف، كهربائيون، حراس أمن، مشرفو التدبير المنزلي.', 'button_text' => 'طلب موظفي المرافق'],
                'bn' => ['title' => 'ফ্যাসিলিটি ম্যানেজমেন্ট', 'description' => 'সাধারণ পরিচ্ছদক, এইচভিএসি টেকনিশিয়ান, ইলেকট্রিশিয়ান, নিরাপত্তা প্রহরী, হাউসকিপিং সুপারভাইজার।', 'button_text' => 'ফ্যাসিলিটি কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-airplane', 'icon_color' => 'text-primary', 'order' => 5,
                'en' => ['title' => 'Airport Services', 'description' => 'Baggage Loaders, Aircraft Cabin Cleaners, Cargo Packers, Customer Assistance Staff.', 'button_text' => 'Request Airport Crew'],
                'ar' => ['title' => 'خدمات المطارات', 'description' => 'محملو الأمتعة، منظفو مقصورة الطائرة، نجارو البضائع، موظفو مساعدة العملاء.', 'button_text' => 'طلب طاقم المطار'],
                'bn' => ['title' => 'বিমানবন্দর পরিষেবা', 'description' => 'ব্যাগেজ লোডার, বিমানের কেবিন পরিচ্ছদক, কার্গো প্যাকার, গ্রাহক সহায়তা কর্মী।', 'button_text' => 'বিমানবন্দর ক্রু অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-heart-pulse', 'icon_color' => 'text-danger', 'order' => 6,
                'en' => ['title' => 'Healthcare Support', 'description' => 'Registered Nurses, Caregivers, Medical Lab Assistants, Hospital Ward Cleaners.', 'button_text' => 'Request Healthcare Staff'],
                'ar' => ['title' => 'دعم الرعاية الصحية', 'description' => 'ممرضون مسجلون، مقدمو الرعاية، مساعدو المختبرات الطبية، عاملو نظافة أجنحة المستشفيات.', 'button_text' => 'طلب موظفي الرعاية الصحية'],
                'bn' => ['title' => 'স্বাস্থ্যসেবা সহায়তা', 'description' => 'নিবন্ধিত নার্স, কেয়ারগিভার, মেডিকেল ল্যাব সহকারী, হাসপাতাল ওয়ার্ড পরিচ্ছদক।', 'button_text' => 'স্বাস্থ্যসেবা কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-egg-fried', 'icon_color' => 'text-warning', 'order' => 7,
                'en' => ['title' => 'Restaurant', 'description' => 'Restaurant Waiters, Stewards, Fast Food Crew, Cleaners.', 'button_text' => 'Request Restaurant Staff'],
                'ar' => ['title' => 'مطعم', 'description' => 'نوادل المطاعم، المضيفون، طاقم الوجبات السريعة، عاملو النظافة.', 'button_text' => 'طلب موظفي المطعم'],
                'bn' => ['title' => 'রেস্তোরাঁ', 'description' => 'রেস্তোরাঁ ওয়েটার, স্টুয়ার্ড, ফাস্ট ফুড ক্রু, পরিচ্ছদক।', 'button_text' => 'রেস্তোরাঁ কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-building-gear', 'icon_color' => 'text-secondary', 'order' => 8,
                'en' => ['title' => 'Hotel', 'description' => 'Receptionists, Bellboys, Room Attendants, Laundry Staff.', 'button_text' => 'Request Hotel Staff'],
                'ar' => ['title' => 'فندق', 'description' => 'موظفو الاستقبال، الصبيان، مضيفو الغرف، موظفو المغسلة.', 'button_text' => 'طلب موظفي الفندق'],
                'bn' => ['title' => 'হোটেল', 'description' => 'রিসেপশনিস্ট, বেলবয়, রুম অ্যাটেনড্যান্ট, লন্ড্রি কর্মী।', 'button_text' => 'হোটেল কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-gear-wide-connected', 'icon_color' => 'text-dark', 'order' => 9,
                'en' => ['title' => 'Manufacturing', 'description' => 'Machine Operators, Assembly Line Workers, Quality Control Inspectors.', 'button_text' => 'Request Manufacturing Staff'],
                'ar' => ['title' => 'التصنيع', 'description' => 'مشغلو الآلات، عمال خط التجميع، مفتشو مراقبة الجودة.', 'button_text' => 'طلب موظفي التصنيع'],
                'bn' => ['title' => 'উৎপাদন', 'description' => 'মেশিন অপারেটর, অ্যাসেম্বলি লাইন কর্মী, কোয়ালিটি কন্ট্রোল ইন্সপেক্টর।', 'button_text' => 'উৎপাদন কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-shop', 'icon_color' => 'text-info', 'order' => 10,
                'en' => ['title' => 'Retail', 'description' => 'Sales Associates, Cashiers, Store Supervisors, Merchandisers.', 'button_text' => 'Request Retail Staff'],
                'ar' => ['title' => 'التجزئة', 'description' => 'مساعدو المبيعات، أمين الصندوق، مشرفو المتاجر، بائعون.', 'button_text' => 'طلب موظفي التجزئة'],
                'bn' => ['title' => 'খুচরা', 'description' => 'সেলস অ্যাসোসিয়েট, ক্যাশিয়ার, স্টোর সুপারভাইজার, মার্চেন্ডাইজার।', 'button_text' => 'খুচরা কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-tree', 'icon_color' => 'text-success', 'order' => 11,
                'en' => ['title' => 'Agriculture', 'description' => 'Farm Workers, Harvesters, Greenhouse Caretakers, Irrigation Technicians.', 'button_text' => 'Request Agriculture Staff'],
                'ar' => ['title' => 'الزراعة', 'description' => 'عاملو المزارع، الحاصدون، القائمون على البيوت الزجاجية، فنيو الري.', 'button_text' => 'طلب موظفي الزراعة'],
                'bn' => ['title' => 'কৃষি', 'description' => 'খামার কর্মী, কাটা কর্মী, গ্রিনহাউস কেয়ারটেকার, সেচ টেকনিশিয়ান।', 'button_text' => 'কৃষি কর্মী অনুরোধ করুন'],
            ],
            [
                'icon' => 'bi bi-stars', 'icon_color' => 'text-primary', 'order' => 12,
                'en' => ['title' => 'Cleaning', 'description' => 'Office Cleaners, Janitors, Window Washers, Deep Cleaning Staff.', 'button_text' => 'Request Cleaning Staff'],
                'ar' => ['title' => 'التنظيف', 'description' => 'عاملو تنظيف المكاتب، القائمون على التنظيف، غاسلو النوافذ، موظفو التنظيف العميق.', 'button_text' => 'طلب موظفي التنظيف'],
                'bn' => ['title' => 'পরিষ্কার-পরিচ্ছন্নতা', 'description' => 'অফিস ক্লিনার, জ্যানিটর, উইন্ডো ওয়াশার, ডিপ ক্লিনিং স্টাফ।', 'button_text' => 'ক্লিনিং কর্মী অনুরোধ করুন'],
            ],
        ];

        foreach ($industries as $item) {
            $industry = Industry::create([
                'icon' => $item['icon'],
                'icon_color' => $item['icon_color'],
                'order' => $item['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $industry->translateOrNew($locale)->title = $item[$locale]['title'];
                $industry->translateOrNew($locale)->description = $item[$locale]['description'];
                $industry->translateOrNew($locale)->button_text = $item[$locale]['button_text'];
            }
            $industry->save();
        }
    }
}