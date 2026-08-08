<?php

namespace Database\Seeders;

use App\Models\CompanyDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('company_details_translations')->truncate();
        DB::table('company_details')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create main record
        $company = CompanyDetails::create([
            'email1' => 'info@eminentint.com',
            'email2' => 'ksa@eminentint.com',
            'phone1' => '+880 01894-XXXXXX',
            'phone2' => '+966 5X XXX XXXX',
            'whatsapp' => '8801894XXXXXX',
            'website' => 'https://eminentint.com',
            'facebook' => 'https://facebook.com/eminentint',
            'twitter' => 'https://twitter.com/eminentint',
            'linkedin' => 'https://linkedin.com/company/eminentint',
            'youtube' => 'https://youtube.com/@eminentint',
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'currency' => 'SAR',
            'company_reg_number' => 'RL: 1842',
            'opening_time' => 'Sat - Thu: 9:00 AM - 6:00 PM',
            'company_logo' => 'logo.svg',
            'footer_logo' => 'footer_logo.svg',
            'fav_icon' => 'fav_icon.svg',
        ]);

        // Insert translations manually
        $translations = [
            [
                'company_details_id' => $company->id,
                'locale' => 'en',
                'company_name' => 'Eminent International',
                'address1' => 'House # 123, Road # 5, Block # F, Banani, Dhaka-1213, Bangladesh',
                'address2' => 'King Fahd Road, Olaya District, Riyadh, Kingdom of Saudi Arabia',
                'about_us' => 'Eminent International is a Bangladesh licensed recruiting agency and Saudi licensed company, providing reliable workforce solutions worldwide.',
                'footer_content' => 'Eminent International. All Rights Reserved.',
            ],
            [
                'company_details_id' => $company->id,
                'locale' => 'ar',
                'company_name' => 'إميننت إنترناشونال',
                'address1' => 'المنزل رقم 123، الطريق رقم 5، بلوك F، بناني، دكا-1213، بنغلاديش',
                'address2' => 'طريق الملك فهد، حي العليا، الرياض، المملكة العربية السعودية',
                'about_us' => 'إميننت إنترناشونال هي وكالة توظيف مرخصة في بنغلاديش وشركة مرخصة في المملكة العربية السعودية، وتوفر حلولًا موثوقة للقوى العاملة على مستوى العالم.',
                'footer_content' => 'إميننت إنترناشونال. جميع الحقوق محفوظة.',
            ],
            [
                'company_details_id' => $company->id,
                'locale' => 'bn',
                'company_name' => 'এমিনেন্ট ইন্টারন্যাশনাল',
                'address1' => 'বাড়ি # ১২৩, রোড # ৫, ব্লক # এফ, বনানী, ঢাকা-১২১৩, বাংলাদেশ',
                'address2' => 'কিং ফাহদ রোড, ওলায়া জেলা, রিয়াদ, সৌদি আরব',
                'about_us' => 'এমিনেন্ট ইন্টারন্যাশনাল একটি বাংলাদেশী লাইসেন্সপ্রাপ্ত নিয়োগ সংস্থা এবং সৌদি লাইসেন্সপ্রাপ্ত কোম্পানি, যা বিশ্বব্যাপী নির্ভরযোগ্য কর্মী সমাধান প্রদান করে।',
                'footer_content' => 'এমিনেন্ট ইন্টারন্যাশনাল. সর্বস্বত্ব সংরক্ষিত।',
            ],
        ];

        DB::table('company_details_translations')->insert($translations);
    }
}