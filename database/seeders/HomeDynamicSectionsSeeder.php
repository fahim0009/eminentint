<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DualFeature;
use App\Models\WorkforceStatement;
use App\Models\Partner;
use App\Models\Testimonial;

class HomeDynamicSectionsSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to safely truncate tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DualFeature::truncate();
        WorkforceStatement::truncate();
        Partner::truncate();
        Testimonial::truncate();

        DB::table('dual_feature_translations')->truncate();
        DB::table('workforce_statement_translations')->truncate();
        DB::table('partner_translations')->truncate();
        DB::table('testimonial_translations')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $locales = ['en', 'ar', 'bn'];

        // ==========================================
        // 1. Dual Feature (Employers & Job Seekers)
        // ==========================================
        $dual = DualFeature::create([
            'id' => 1,
            'employer_image' => null,
            'jobseeker_image' => null,
        ]);

        $employerList = '<ul><li>Skilled, Semi-Skilled &amp; Unskilled Workers</li><li>Bulk &amp; Fast-Track Project Recruitment</li><li>Trade Testing &amp; Medical Screening</li><li>Legal Visa Processing &amp; BMET Clearance</li><li>Post-Arrival &amp; On-Site Support</li></ul>';
        $jobseekerList = '<ul><li>100% Free Account Registration</li><li>Direct Employment with Verified Companies</li><li>Safe &amp; Transparent Visa Processing</li><li>No Hidden Agent Fees or Fraud</li><li>Pre-Departure Orientation &amp; Training</li></ul>';

        foreach ($locales as $loc) {
            $dual->translateOrNew($loc)->employer_tag = 'FOR EMPLOYERS';
            $dual->translateOrNew($loc)->employer_title = 'Complete End-to-End Workforce Solutions';
            $dual->translateOrNew($loc)->employer_desc = 'We provide custom manpower solutions tailored to your project requirements with full legal compliance in Bangladesh and Saudi Arabia.';
            $dual->translateOrNew($loc)->employer_list = $employerList;
            $dual->translateOrNew($loc)->employer_btn_text = 'Hire Workers Now';

            $dual->translateOrNew($loc)->jobseeker_tag = 'FOR JOB SEEKERS';
            $dual->translateOrNew($loc)->jobseeker_title = 'Build Your International Career Safely';
            $dual->translateOrNew($loc)->jobseeker_desc = 'Find genuine job opportunities in Saudi Arabia, Gulf & Europe with government-verified recruitment transparency.';
            $dual->translateOrNew($loc)->jobseeker_list = $jobseekerList;
            $dual->translateOrNew($loc)->jobseeker_btn_text = 'Apply for Job Opportunities';
        }
        $dual->save();

        // ==========================================
        // 2. Workforce Statement (Navy Banner)
        // ==========================================
        $statement = WorkforceStatement::create(['id' => 1, 'status' => 1]);

        foreach ($locales as $loc) {
            $statement->translateOrNew($loc)->title = 'Trusted Workforce Partner for Saudi Arabia & Global Employers';
            $statement->translateOrNew($loc)->description = 'From sourcing and screening to deployment and post-arrival support, Eminent International delivers complete workforce solutions with full legal compliance in Bangladesh and Saudi Arabia.';
            $statement->translateOrNew($loc)->btn1_text = 'Submit Worker Requirement';
            $statement->translateOrNew($loc)->btn2_text = 'Contact Our Offices';
        }
        $statement->save();

        // ==========================================
        // 3. Trusted Partners (CRUD)
        // ==========================================
        $partners = [
            ['name' => 'Al Yamama Contracting', 'country' => 'Saudi Arabia', 'flag' => '🇸🇦', 'icon' => 'bi-building', 'color' => 'text-primary'],
            ['name' => 'Al Falah Hospitality', 'country' => 'Saudi Arabia', 'flag' => '🇸🇦', 'icon' => 'bi-cup-hot', 'color' => 'text-warning'],
            ['name' => 'Al Yusr Facility Mgmt', 'country' => 'Qatar', 'flag' => '🇶🇦', 'icon' => 'bi-tools', 'color' => 'text-danger'],
            ['name' => 'Rapid Express LLC', 'country' => 'UAE', 'flag' => '🇦🇪', 'icon' => 'bi-truck', 'color' => 'text-success'],
            ['name' => 'Descon Operations', 'country' => 'Oman', 'flag' => '🇴🇲', 'icon' => 'bi-gear-fill', 'color' => 'text-info'],
            ['name' => 'Malta Ground Handling', 'country' => 'Malta (EU)', 'flag' => '🇲🇹', 'icon' => 'bi-airplane', 'color' => 'text-primary'],
            ['name' => 'Saudi Oger Tech', 'country' => 'Saudi Arabia', 'flag' => '🇸🇦', 'icon' => 'bi-building-gear', 'color' => 'text-dark'],
            ['name' => 'CareFirst Healthcare', 'country' => 'Poland (EU)', 'flag' => '🇵🇱', 'icon' => 'bi-heart-pulse', 'color' => 'text-danger'],
        ];

        foreach ($partners as $key => $p) {
            $partner = Partner::create([
                'icon_class' => $p['icon'],
                'icon_color' => $p['color'],
                'country_flag' => $p['flag'],
                'order' => $key + 1,
                'status' => 1,
            ]);

            foreach ($locales as $loc) {
                $partner->translateOrNew($loc)->name = $p['name'];
                $partner->translateOrNew($loc)->country = $p['country'];
            }
            $partner->save();
        }

        // ==========================================
        // 4. Testimonials (CRUD)
        // ==========================================
        $testimonials = [
            [
                'name' => 'Engr. Abdullah Youssef', 
                'role' => 'Project Director, Al Yamama Contracting (KSA)', 
                'text' => 'Eminent International supplied 250 skilled steel fixers and masons for our Riyadh megaproject within 35 days. Their trade testing center in Dhaka guarantees genuine skills.', 
                'stars' => 5, 'color' => 'bg-navy'
            ],
            [
                'name' => 'Tariq Al-Falah', 
                'role' => 'Head of HR, Al Falah Catering (Jeddah, KSA)', 
                'text' => 'Outstanding service! All 80 baristas, chefs, and waitstaff passed GAMCA medical checks and Saudi visa stamping without a single delay. Very professional team.', 
                'stars' => 5, 'color' => 'bg-danger'
            ],
            [
                'name' => 'Sultan Al-Mansoori', 
                'role' => 'Operations Lead, Rapid Express LLC (Dubai, UAE)', 
                'text' => 'Transparent recruitment partner. They handle BMET clearance and pre-departure orientation rigorously so workers arrive disciplined and project-ready.', 
                'stars' => 5, 'color' => 'bg-warning text-dark'
            ],
            [
                'name' => 'Marcus Vance', 
                'role' => 'Recruitment Director, Malta Ground Services (EU)', 
                'text' => 'Direct Saudi Embassy visa stamping and zero hassle. Their dual Bangladesh RL and Saudi CR legal standing gives total peace of mind for bulk hiring.', 
                'stars' => 5, 'color' => 'bg-success'
            ],
        ];

        foreach ($testimonials as $key => $t) {
            $testimonial = Testimonial::create([
                'stars' => $t['stars'],
                'avatar_bg_color' => $t['color'],
                'order' => $key + 1,
                'status' => 1,
            ]);

            foreach ($locales as $loc) {
                $testimonial->translateOrNew($loc)->reviewer_name = $t['name'];
                $testimonial->translateOrNew($loc)->reviewer_role = $t['role'];
                $testimonial->translateOrNew($loc)->review_text = $t['text'];
            }
            $testimonial->save();
        }
    }
}