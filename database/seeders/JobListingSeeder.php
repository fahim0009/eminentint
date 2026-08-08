<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
                // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::table('company_details_translations')->truncate();
        DB::table('company_details')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $jobs = [
            [
                'country' => 'Saudi Arabia', 'city' => 'Riyadh', 'industry' => 'Hospitality', 'vacancy_count' => 50, 'order' => 1,
                'en' => ['title' => 'Barista & Coffee Specialist', 'company_name' => 'Al Falah Hospitality Group', 'salary' => '2,200 SAR / Month', 'benefits' => 'Free Food, Accommodation, Transport & Medical', 'requirements' => '1-2 Years Experience, Basic English or Arabic'],
                'ar' => ['title' => 'باريستا وأخصائي قهوة', 'company_name' => 'مجموعة الفلاح للضيافة', 'salary' => '2,200 ريال / شهر', 'benefits' => 'طعام مجاني، سكن، مواصلات وطبية', 'requirements' => 'خبرة 1-2 سنوات، أساسيات الإنجليزية أو العربية'],
                'bn' => ['title' => 'বারিস্টা এবং কফি বিশেষজ্ঞ', 'company_name' => 'আল ফালাহ হসপিটালিটি গ্রুপ', 'salary' => '২,২০০ এসএআর / মাস', 'benefits' => 'বিনামূল্যে খাবার, আবাসন, পরিবহন ও চিকিৎসা', 'requirements' => '১-২ বছরের অভিজ্ঞতা, প্রাথমিক ইংরেজি বা আরবি'],
            ],
            [
                'country' => 'Saudi Arabia', 'city' => 'Jeddah', 'industry' => 'Construction', 'vacancy_count' => 100, 'order' => 2,
                'en' => ['title' => 'Electrician & Control Technician', 'company_name' => 'Saudi Construction Contracting Co.', 'salary' => '1,800 - 2,400 SAR / Month', 'benefits' => 'Free Accommodation, Medical & Overtime Allowance', 'requirements' => 'Trade Test Certificate / Diploma'],
                'ar' => ['title' => 'كهربائي وفني تحكم', 'company_name' => 'شركة المقاولات الإنشائية السعودية', 'salary' => '1,800 - 2,400 ريال / شهر', 'benefits' => 'سكن مجاني، طبي وبدل عمل إضافي', 'requirements' => 'شهادة اختبار المهنة / دبلوم'],
                'bn' => ['title' => 'ইলেকট্রিশিয়ান এবং কন্ট্রোল টেকনিশিয়ান', 'company_name' => 'সৌদি কনস্ট্রাকশন কন্ট্রাক্টিং কো.', 'salary' => '১,৮০০ - ২,৪০০ এসএআর / মাস', 'benefits' => 'বিনামূল্যে আবাসন, চিকিৎসা ও ওভারটাইম ভাতা', 'requirements' => 'ট্রেড টেস্ট সার্টিফিকেট / ডিপ্লোমা'],
            ],
            [
                'country' => 'Saudi Arabia', 'city' => 'Dammam', 'industry' => 'Cleaning', 'vacancy_count' => 150, 'order' => 3,
                'en' => ['title' => 'General Cleaner & Helper', 'company_name' => 'Al Yusr Facility Services', 'salary' => '1,400 SAR + 300 SAR Food', 'benefits' => 'Free Accommodation, Medical & Ticket', 'requirements' => 'Physically fit, No experience needed'],
                'ar' => ['title' => 'عامل نظافة عام ومساعد', 'company_name' => 'خدمات اليسر للمرافق', 'salary' => '1,400 ريال + 300 ريال طعام', 'benefits' => 'سكن مجاني، طبي وتذكرة سفر', 'requirements' => 'لياقة بدنية، لا حاجة لخبرة'],
                'bn' => ['title' => 'সাধারণ পরিচ্ছদক এবং সহায়ক', 'company_name' => 'আল ইউসর ফ্যাসিলিটি সার্ভিসেস', 'salary' => '১,৪০০ এসএআর + ৩০০ এসএআর খাবার', 'benefits' => 'বিনামূল্যে আবাসন, চিকিৎসা ও টিকিট', 'requirements' => 'শারীরিকভাবে সুস্থ, কোনো অভিজ্ঞতার প্রয়োজন নেই'],
            ],
            [
                'country' => 'Malta', 'city' => 'Luqa', 'industry' => 'Logistics', 'vacancy_count' => 30, 'order' => 4,
                'en' => ['title' => 'Airport Baggage Loader', 'company_name' => 'Malta International Airport Ground Services', 'salary' => '1,100 EUR / Month', 'benefits' => 'EU Work Permit, Medical & Accommodation', 'requirements' => 'Basic English, Physical Stamina'],
                'ar' => ['title' => 'محمل أمتعة المطار', 'company_name' => 'خدمات أرضية بمطار مالطا الدولي', 'salary' => '1,100 يورو / شهر', 'benefits' => 'تصريح عمل في الاتحاد الأوروبي، طبي وسكن', 'requirements' => 'أساسيات الإنجليزية، تحمل بدني'],
                'bn' => ['title' => 'বিমানবন্দর ব্যাগেজ লোডার', 'company_name' => 'মাল্টা আন্তর্জাতিক বিমানবন্দর গ্রাউন্ড সার্ভিসেস', 'salary' => '১,১০০ ইউরো / মাস', 'benefits' => 'ইইউ ওয়ার্ক পারমিট, চিকিৎসা ও আবাসন', 'requirements' => 'প্রাথমিক ইংরেজি, শারীরিক সহনশীলতা'],
            ],
            [
                'country' => 'UAE', 'city' => 'Dubai', 'industry' => 'Hospitality', 'vacancy_count' => 40, 'order' => 5,
                'en' => ['title' => 'Restaurant Waiter / Steward', 'company_name' => 'Dubai Grand Catering LLC', 'salary' => '1,800 AED + Tips', 'benefits' => 'Duty Meals, Housing & Health Card', 'requirements' => 'Good spoken English, Smart appearance'],
                'ar' => ['title' => 'نادل مطعم / مضيف', 'company_name' => 'دبي جراند كاترينج ذ.م.م', 'salary' => '1,800 درهم + بقشيش', 'benefits' => 'وجبات العمل، سكن وبطاقة صحية', 'requirements' => 'إجادة التحدث بالإنجليزية، مظهر أنيق'],
                'bn' => ['title' => 'রেস্টুরেন্ট ওয়েটার / স্টুয়ার্ড', 'company_name' => 'দুবাই গ্র্যান্ড ক্যাটারিং এলএলসি', 'salary' => '১,৮০০ এইডি + টিপস', 'benefits' => 'ডিউটি মিলস, হাউজিং এবং হেলথ কার্ড', 'requirements' => 'যোগাযোগের জন্য সাবলীল ইংরেজি, পরিপাটি চেহারা'],
            ],
            [
                'country' => 'Poland', 'city' => 'Warsaw', 'industry' => 'Logistics', 'vacancy_count' => 25, 'order' => 6,
                'en' => ['title' => 'Forklift Driver & Warehouse Packer', 'company_name' => 'Logistics Poland Sp. z o.o.', 'salary' => '950 EUR / Month', 'benefits' => 'TRC Work Residence, Accommodation Provided', 'requirements' => 'Valid Driving License / Forklift Certificate'],
                'ar' => ['title' => 'سائق رافعة شوكية وعامل مستودع', 'company_name' => 'لوجستيك بولندا ش.ذ.م.م', 'salary' => '950 يورو / شهر', 'benefits' => 'إقامة عمل TRC، سكن مجاني', 'requirements' => 'رخصة قيادة سارية / شهادة رافعة شوكية'],
                'bn' => ['title' => 'ফোর্কলিফট ড্রাইভার এবং ওয়্যারহাউস প্যাকার', 'company_name' => 'লজিস্টিকস পোল্যান্ড স্প. জেড ও.ও.', 'salary' => '৯৫০ ইউরো / মাস', 'benefits' => 'টিআরসি ওয়ার্ক রেসিডেন্স, আবাসন সরবরাহ করা হয়', 'requirements' => 'বৈধ ড্রাইভিং লাইসেন্স / ফোর্কলিফট সার্টিফিকেট'],
            ],
            [
                'country' => 'Qatar', 'city' => 'Doha', 'industry' => 'Security', 'vacancy_count' => 80, 'order' => 7,
                'en' => ['title' => 'Security Guard', 'company_name' => 'Doha Security Services', 'salary' => '1,500 QAR / Month', 'benefits' => 'Accommodation, Transportation, Uniform', 'requirements' => 'Minimum Height 165cm, Good Health'],
                'ar' => ['title' => 'حارس أمن', 'company_name' => 'خدمات أمن الدوحة', 'salary' => '1,500 ريال قطري / شهر', 'benefits' => 'سكن، مواصلات، زي رسمي', 'requirements' => 'الحد الأدنى للطول 165 سم، صحة جيدة'],
                'bn' => ['title' => 'সিকিউরিটি গার্ড', 'company_name' => 'দোহা সিকিউরিটি সার্ভিসেস', 'salary' => '১,৫০০ কিউআর / মাস', 'benefits' => 'আবাসন, পরিবহন, ইউনিফর্ম', 'requirements' => 'ন্যূনতম উচ্চতা ১৬৫ সেমি, ভালো স্বাস্থ্য'],
            ],
            [
                'country' => 'Oman', 'city' => 'Muscat', 'industry' => 'Construction', 'vacancy_count' => 60, 'order' => 8,
                'en' => ['title' => 'Mason & Plasterer', 'company_name' => 'Muscat Builders LLC', 'salary' => '160 OMR / Month', 'benefits' => 'Accommodation & Medical Insurance', 'requirements' => '3+ Years GCC Experience Preferred'],
                'ar' => ['title' => 'بناء وقصارة', 'company_name' => 'مسقط بيلدرز ذ.م.م', 'salary' => '160 ريال عماني / شهر', 'benefits' => 'سكن وتأمين طبي', 'requirements' => 'يفضل خبرة 3+ سنوات في دول الخليج'],
                'bn' => ['title' => 'রাজমিস্ত্রি এবং প্লাস্টারার', 'company_name' => 'মাস্কাট বিল্ডার্স এলএলসি', 'salary' => '১৬০ ওএমআর / মাস', 'benefits' => 'আবাসন এবং চিকিৎসা বীমা', 'requirements' => 'জিসিসি-তে ৩+ বছরের অভিজ্ঞতা অগ্রাধিকার পাবে'],
            ],
            [
                'country' => 'Saudi Arabia', 'city' => 'Mecca', 'industry' => 'Hospitality', 'vacancy_count' => 200, 'order' => 9,
                'en' => ['title' => 'Hotel Housekeeper', 'company_name' => 'Mecca Royal Hotels', 'salary' => '1,600 SAR / Month', 'benefits' => 'Free Food, Accommodation, Medical, Flight Ticket', 'requirements' => 'Experience in hotel cleaning, Hardworking'],
                'ar' => ['title' => 'عامل تنظيف غرف فندق', 'company_name' => 'فنادق مكة الملكية', 'salary' => '1,600 ريال / شهر', 'benefits' => 'طعام مجاني، سكن، طبي، تذكرة طيران', 'requirements' => 'خبرة في تنظيف الفنادق، اجتهاد'],
                'bn' => ['title' => 'হোটেল হাউসকিপার', 'company_name' => 'মক্কা রয়্যাল হোটেল', 'salary' => '১,৬০০ এসএআর / মাস', 'benefits' => 'বিনামূল্যে খাবার, আবাসন, চিকিৎসা, ফ্লাইট টিকিট', 'requirements' => 'হোটেল পরিষ্কারে অভিজ্ঞতা, পরিশ্রমী'],
            ],
            [
                'country' => 'UAE', 'city' => 'Abu Dhabi', 'industry' => 'Driving', 'vacancy_count' => 50, 'order' => 10,
                'en' => ['title' => 'Heavy Bus Driver', 'company_name' => 'Abu Dhabi Transport Corp', 'salary' => '3,000 AED / Month', 'benefits' => 'Accommodation, Transportation, Overtime', 'requirements' => 'Valid Heavy Vehicle License # 5, 6'],
                'ar' => ['title' => 'سائق حافلة ثقيلة', 'company_name' => 'شركة أبوظبي للنقل', 'salary' => '3,000 درهم / شهر', 'benefits' => 'سكن، مواصلات، عمل إضافي', 'requirements' => 'رخصة مركبة ثقيلة سارية # 5، 6'],
                'bn' => ['title' => 'ভারী বাস ড্রাইভার', 'company_name' => 'আবুধাবি ট্রান্সপোর্ট কর্প', 'salary' => '৩,০০০ এইডি / মাস', 'benefits' => 'আবাসন, পরিবহন, ওভারটাইম', 'requirements' => 'বৈধ ভারী যানবাহন লাইসেন্স # 5, 6'],
            ],
        ];

        foreach ($jobs as $jobData) {
            $job = JobListing::create([
                'country' => $jobData['country'],
                'city' => $jobData['city'],
                'industry' => $jobData['industry'],
                'vacancy_count' => $jobData['vacancy_count'],
                'order' => $jobData['order'],
                'status' => 1,
            ]);

            // Set English
            $job->translateOrNew('en')->title = $jobData['en']['title'];
            $job->translateOrNew('en')->sub_title = $jobData['en']['company_name'];
            $job->translateOrNew('en')->company_name = $jobData['en']['company_name'];
            $job->translateOrNew('en')->salary = $jobData['en']['salary'];
            $job->translateOrNew('en')->benefits = $jobData['en']['benefits'];
            $job->translateOrNew('en')->requirements = $jobData['en']['requirements'];

            // Set Arabic
            $job->translateOrNew('ar')->title = $jobData['ar']['title'];
            $job->translateOrNew('ar')->sub_title = $jobData['ar']['company_name'];
            $job->translateOrNew('ar')->company_name = $jobData['ar']['company_name'];
            $job->translateOrNew('ar')->salary = $jobData['ar']['salary'];
            $job->translateOrNew('ar')->benefits = $jobData['ar']['benefits'];
            $job->translateOrNew('ar')->requirements = $jobData['ar']['requirements'];

            // Set Bengali
            $job->translateOrNew('bn')->title = $jobData['bn']['title'];
            $job->translateOrNew('bn')->sub_title = $jobData['bn']['company_name'];
            $job->translateOrNew('bn')->company_name = $jobData['bn']['company_name'];
            $job->translateOrNew('bn')->salary = $jobData['bn']['salary'];
            $job->translateOrNew('bn')->benefits = $jobData['bn']['benefits'];
            $job->translateOrNew('bn')->requirements = $jobData['bn']['requirements'];

            $job->save();
        }
    }
}