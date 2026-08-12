<?php

namespace Database\Seeders;

use App\Models\CompanyDetails;
use Illuminate\Database\Seeder;

class CompanyDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // CompanyDetails::truncate();

        $company = CompanyDetails::create([
            // Non-Translatable Fields
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
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.058866380628!2d90.4042893!3d23.7808875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7715a40c603%3A0xec01cd75f3333333!2sBanani%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'google_map2' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28987.35824982!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sKing%20Fahd%20Rd%2C%20Riyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'company_reg_number' => 'RL: 1842',
            'vat_number' => 'CR: 1010778401',
            'opening_time' => 'Sun - Thu: 9:00 AM - 6:00 PM',
            'company_logo' => 'logo.svg',
            'footer_logo' => 'footer_logo.svg',
            'fav_icon' => 'fav_icon.svg',
        ]);

        // --- English Translations ---
        $company->translateOrNew('en')->company_name = 'Eminent International';
        $company->translateOrNew('en')->address1 = 'House # 123, Road # 5, Block # F, Banani, Dhaka-1213, Bangladesh (RL: 1842)';
        $company->translateOrNew('en')->address2 = 'King Fahd Road, Olaya District, Riyadh, Kingdom of Saudi Arabia (CR: 1010778401)';
        $company->translateOrNew('en')->about_us = 'Eminent International is a Bangladesh licensed recruiting agency and Saudi licensed company, providing reliable workforce solutions worldwide.';
        $company->translateOrNew('en')->footer_content = 'Eminent International is a Bangladesh licensed recruiting agency and Saudi licensed company, providing reliable workforce solutions worldwide.';
        $company->translateOrNew('en')->copyright = '© 2026 Eminent International. All Rights Reserved.';

        // --- Arabic Translations ---
        $company->translateOrNew('ar')->company_name = 'إميننت إنترناشونال';
        $company->translateOrNew('ar')->address1 = 'المنزل رقم 123، الطريق رقم 5، بلوك F، بناني، دكا-1213، بنغلاديش (RL: 1842)';
        $company->translateOrNew('ar')->address2 = 'طريق الملك فهد، حي العليا، الرياض، المملكة العربية السعودية (CR: 1010778401)';
        $company->translateOrNew('ar')->about_us = 'إميننت إنترناشونال هي وكالة توظيف مرخصة في بنغلاديش وشركة مرخصة في المملكة العربية السعودية، وتوفر حلولًا موثوقة للقوى العاملة على مستوى العالم.';
        $company->translateOrNew('ar')->footer_content = 'إميننت إنترناشونال هي وكالة توظيف مرخصة في بنغلاديش وشركة مرخصة في المملكة العربية السعودية، وتوفر حلولًا موثوقة للقوى العاملة على مستوى العالم.';
        $company->translateOrNew('ar')->copyright = '© 2026 إميننت إنترناشونال. جميع الحقوق محفوظة.';

        // --- Bengali Translations ---
        $company->translateOrNew('bn')->company_name = 'এমিনেন্ট ইন্টারন্যাশনাল';
        $company->translateOrNew('bn')->address1 = 'বাড়ি # ১২৩, রোড # ৫, ব্লক # এফ, বনানী, ঢাকা-১২১৩, বাংলাদেশ (RL: 1842)';
        $company->translateOrNew('bn')->address2 = 'কিং ফাহদ রোড, ওলায়া জেলা, রিয়াদ, সৌদি আরব (CR: 1010778401)';
        $company->translateOrNew('bn')->about_us = 'এমিনেন্ট ইন্টারন্যাশনাল একটি বাংলাদেশী লাইসেন্সপ্রাপ্ত নিয়োগ সংস্থা এবং সৌদি লাইসেন্সপ্রাপ্ত কোম্পানি, যা বিশ্বব্যাপী নির্ভরযোগ্য কর্মী সমাধান প্রদান করে।';
        $company->translateOrNew('bn')->footer_content = 'এমিনেন্ট ইন্টারন্যাশনাল একটি বাংলাদেশী লাইসেন্সপ্রাপ্ত নিয়োগ সংস্থা এবং সৌদি লাইসেন্সপ্রাপ্ত কোম্পানি, যা বিশ্বব্যাপী নির্ভরযোগ্য কর্মী সমাধান প্রদান করে।';
        $company->translateOrNew('bn')->copyright = '© ২০২৬ এমিনেন্ট ইন্টারন্যাশনাল. সর্বস্বত্ব সংরক্ষিত।';

        $company->save();
    }
}