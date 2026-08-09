<?php

namespace Database\Seeders;

use App\Models\CompanyLicense;
use Illuminate\Database\Seeder;

class CompanyLicenseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        // CompanyLicense::truncate();

        $licenses = [
            [
                'reg_no' => 'RL-1842', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-navy', 'border_class' => null, 
                'icon_class' => 'bi-file-earmark-pdf-fill', 'icon_color' => 'text-maroon', 'order' => 1,
                'en' => ['status_badge' => 'Active', 'prefix_badge' => 'Bangladesh Govt Approved', 'title' => 'Recruiting License (RL-1842)', 'description' => "Issued by Ministry of Expatriates' Welfare & Overseas Employment, Govt of Bangladesh.", 'reg_detail' => 'Issued for International Staff Deployment'],
                'ar' => ['status_badge' => 'نشط', 'prefix_badge' => 'معتمدة من حكومة بنغلاديش', 'title' => 'رخصة التوظيف (RL-1842)', 'description' => "صادرة عن وزارة رعاية المغتربين والتوظيف في الخارج، حكومة بنغلاديش.", 'reg_detail' => 'صادرة لنشر الموظفين الدوليين'],
                'bn' => ['status_badge' => 'সক্রিয়', 'prefix_badge' => 'বাংলাদেশ সরকার অনুমোদিত', 'title' => 'নিয়োগ লাইসেন্স (RL-1842)', 'description' => "প্রবাসী কল্যাণ ও সীমান্তবর্তী কর্মসংস্থান মন্ত্রণালয়, বাংলাদেশ সরকার কর্তৃক প্রদত্ত।", 'reg_detail' => 'আন্তর্জাতিক কর্মী মোতায়েনের জন্য প্রদত্ত'],
            ],
            [
                'reg_no' => 'BMET-REG-8821', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-navy', 'border_class' => null, 
                'icon_class' => 'bi-award-fill', 'icon_color' => 'text-navy', 'order' => 2,
                'en' => ['status_badge' => 'Active', 'prefix_badge' => 'BMET Clearance Authorized', 'title' => 'BMET Approval Certificate', 'description' => 'Bureau of Manpower, Employment and Training approval for overseas candidate processing.', 'reg_detail' => 'Authorized Manpower Exporter'],
                'ar' => ['status_badge' => 'نشط', 'prefix_badge' => 'مخول بموافقة BMET', 'title' => 'شهادة موافقة BMET', 'description' => 'موافقة مكتب القوى العاملة والتدريب والتوظيف لمعالجة المرشحين في الخارج.', 'reg_detail' => 'مصدر معتمد للقوى العاملة'],
                'bn' => ['status_badge' => 'সক্রিয়', 'prefix_badge' => 'বিএমইটি ছাড়পত্র অনুমোদিত', 'title' => 'বিএমইটি অনুমোদন সনদপত্র', 'description' => 'বিদেশী প্রার্থী প্রক্রিয়াকরণের জন্য ম্যানপাওয়ার, কর্মসংস্থান ও প্রশিক্ষণ ব্যুরোর অনুমোদন।', 'reg_detail' => 'অনুমোদিত ম্যানপাওয়ার রপ্তানিকারক'],
            ],
            [
                'reg_no' => 'TRAD/DNCC/019241', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-navy', 'border_class' => null, 
                'icon_class' => 'bi-file-text-fill', 'icon_color' => 'text-gold', 'order' => 3,
                'en' => ['status_badge' => 'Active', 'prefix_badge' => 'Dhaka North City Corp', 'title' => 'Bangladesh Trade License', 'description' => 'Commercial operation license issued by Banani Zone, Dhaka City Corporation.', 'reg_detail' => 'Valid Business Operation Permit'],
                'ar' => ['status_badge' => 'نشط', 'prefix_badge' => 'شركة داكا الشمالية', 'title' => 'رخصة تجارية بنغلاديش', 'description' => 'رخصة تشغيل تجاري صادرة عن منطقة بناني، شركة داكا سيتي.', 'reg_detail' => 'تصريح تشغيل تجاري ساري المفعول'],
                'bn' => ['status_badge' => 'সক্রিয়', 'prefix_badge' => 'ঢাকা উত্তর সিটি কর্প', 'title' => 'বাংলাদেশ ট্রেড লাইসেন্স', 'description' => 'বানানী জোন, ঢাকা সিটি কর্পোরেশন কর্তৃক প্রদত্ত বাণিজ্যিক পরিচালনা লাইসেন্স।', 'reg_detail' => 'বৈধ ব্যবসায়িক পরিচালনা পারমিট'],
            ],
            [
                'reg_no' => 'CR: 1010778401', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-success', 'border_class' => 'border-start border-4 border-success', 
                'icon_class' => 'bi-shield-check', 'icon_color' => 'text-success', 'order' => 4,
                'en' => ['status_badge' => 'Saudi Verified', 'prefix_badge' => 'Saudi Ministry of Commerce', 'title' => 'Saudi Commercial Registration (CR)', 'description' => 'Official Saudi CR for manpower, hospitality & general trading operations in Riyadh, KSA.', 'reg_detail' => 'MOCI Authorized Saudi Business'],
                'ar' => ['status_badge' => 'تحقق سعودي', 'prefix_badge' => 'وزارة التجارة السعودية', 'title' => 'السجل التجاري السعودي (CR)', 'description' => 'سجل تجاري سعودي رسمي للعمليات المتعلقة بالقوى العاملة والضيافة والتجارة العامة في الرياض، المملكة العربية السعودية.', 'reg_detail' => 'عمل تجاري سعودي معتمد من MOCI'],
                'bn' => ['status_badge' => 'সৌদি যাচাইকৃত', 'prefix_badge' => 'সৌদি বাণিজ্য মন্ত্রণালয়', 'title' => 'সৌদি বাণিজ্যিক নিবন্ধন (CR)', 'description' => 'রিয়াদ, কেএসএ-তে ম্যানপাওয়ার, আতিথেয়তা এবং সাধারণ ট্রেডিং কার্যক্রমের জন্য অফিসিয়াল সৌদি CR।', 'reg_detail' => 'MOCI অনুমোদিত সৌদি ব্যবসা'],
            ],
            [
                'reg_no' => 'MOCI-SAUDI-2024', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-success', 'border_class' => 'border-start border-4 border-success', 
                'icon_class' => 'bi-file-earmark-check-fill', 'icon_color' => 'text-primary', 'order' => 5,
                'en' => ['status_badge' => 'Municipality Approved', 'prefix_badge' => 'Riyadh Municipality', 'title' => 'Saudi Service & Trading License', 'description' => 'Authorized manpower staffing and labor supply license issued in Riyadh.', 'reg_detail' => 'Labor Supply & Contracting Permit'],
                'ar' => ['status_badge' => 'معتمد من البلدية', 'prefix_badge' => 'بلدية الرياض', 'title' => 'رخصة الخدمات والتجارة السعودية', 'description' => 'رخصة معتمدة لتوظيف العمالة وتوريد العمالة الصادرة في الرياض.', 'reg_detail' => 'تصريح توريد العمالة والمقاولات'],
                'bn' => ['status_badge' => 'পৌরসভা অনুমোদিত', 'prefix_badge' => 'রিয়াদ পৌরসভা', 'title' => 'সৌদি সার্ভিস ও ট্রেডিং লাইসেন্স', 'description' => 'রিয়াদে জারি করা অনুমোদিত ম্যানপাওয়ার স্টাফিং এবং শ্রম সরবরাহ লাইসেন্স।', 'reg_detail' => 'শ্রম সরবরাহ ও চুক্তি পারমিট'],
            ],
            [
                'reg_no' => 'DCCI-2026-MEM', 'badge_color' => 'bg-success', 'prefix_badge_color' => 'bg-navy', 'border_class' => null, 
                'icon_class' => 'bi-building-check', 'icon_color' => 'text-warning', 'order' => 6,
                'en' => ['status_badge' => 'Verified Member', 'prefix_badge' => 'Chamber Membership', 'title' => 'Chamber of Commerce Membership', 'description' => 'Verified corporate member of Dhaka Chamber of Commerce & Industry (DCCI).', 'reg_detail' => 'Registered Corporate Member'],
                'ar' => ['status_badge' => 'عضو موثق', 'prefix_badge' => 'عضوية الغرفة', 'title' => 'عضوية غرفة التجارة', 'description' => 'عضو مؤسسي موثق في غرفة التجارة والصناعة في دكا (DCCI).', 'reg_detail' => 'عضو مؤسسي مسجل'],
                'bn' => ['status_badge' => 'যাচাইকৃত সদস্য', 'prefix_badge' => 'চেম্বার সদস্যপদ', 'title' => 'চেম্বার অফ কমার্স সদস্যপদ', 'description' => 'ঢাকা চেম্বার অফ কমার্স অ্যান্ড ইন্ডাস্ট্রির (DCCI) যাচাইকৃত কর্পোরেট সদস্য।', 'reg_detail' => 'নিবন্ধিত কর্পোরেট সদস্য'],
            ],
        ];

        foreach ($licenses as $licenseData) {
            $license = CompanyLicense::create([
                'reg_no' => $licenseData['reg_no'],
                'badge_color' => $licenseData['badge_color'],
                'prefix_badge_color' => $licenseData['prefix_badge_color'],
                'border_class' => $licenseData['border_class'],
                'icon_class' => $licenseData['icon_class'],
                'icon_color' => $licenseData['icon_color'],
                'order' => $licenseData['order'],
                'status' => 1,
            ]);

            foreach (['en', 'ar', 'bn'] as $locale) {
                $license->translateOrNew($locale)->status_badge = $licenseData[$locale]['status_badge'];
                $license->translateOrNew($locale)->prefix_badge = $licenseData[$locale]['prefix_badge'];
                $license->translateOrNew($locale)->title = $licenseData[$locale]['title'];
                $license->translateOrNew($locale)->description = $licenseData[$locale]['description'];
                $license->translateOrNew($locale)->reg_detail = $licenseData[$locale]['reg_detail'];
            }

            $license->save();
        }
    }
}