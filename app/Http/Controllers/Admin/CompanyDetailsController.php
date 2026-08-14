<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDetails;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CompanyDetailsController extends Controller
{
    
    private function translateAndSet($model, $field, $englishValue)
    {
        $englishValue = trim((string)$englishValue);

        // Astrotomic uses translateOrNew() instead of setTranslation()
        $model->translateOrNew('en')->{$field} = $englishValue;

        if ($englishValue === '') {
            $model->translateOrNew('ar')->{$field} = '';
            $model->translateOrNew('bn')->{$field} = '';
            return;
        }

        try {
            $model->translateOrNew('ar')->{$field} = (new GoogleTranslate('ar'))->translate($englishValue);
            $model->translateOrNew('bn')->{$field} = (new GoogleTranslate('bn'))->translate($englishValue);
        } catch (\Exception $e) {
            // Fallback to English if Google Translate fails
            $model->translateOrNew('ar')->{$field} = $englishValue;
            $model->translateOrNew('bn')->{$field} = $englishValue;
        }
    }

    /**
     * Display the main company details form.
     */
    public function index()
    {
        $data = CompanyDetails::firstOrCreate(['id' => 1]);
        return view('admin.company.index', compact('data'));
    }

    /**
     * Update the main company details.
     */
    public function update(Request $request)
    {
        // Use firstOrCreate instead of first() to prevent errors if table is empty
        $data = CompanyDetails::firstOrCreate(['id' => 1]);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'business_name' => 'nullable|max:255',
            'email1' => 'nullable|email|max:255',
            'email2' => 'nullable|email|max:255',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'phone3' => 'nullable|string|max:20',
            'phone4' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'tawkto' => 'nullable|string|max:255',
            'vat_percent' => 'nullable|string|max:255',
            'google_appstore_link' => 'nullable|string|max:255',
            'google_play_link' => 'nullable|string|max:255',
            'footer_link' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'google_map' => 'nullable|string',
            'company_reg_number' => 'nullable|string',
            'vat_number' => 'nullable|string',
            'fav_icon' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'company_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'footer_logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // --- Handle File Uploads ---
        if ($request->hasFile('fav_icon')) {
            if ($data->fav_icon && file_exists(public_path('uploads/company/' . $data->fav_icon))) {
                unlink(public_path('uploads/company/' . $data->fav_icon));
            }
            $favIconName = rand(100000, 999999) . '_fav_icon.' . $request->fav_icon->extension();
            $request->fav_icon->move(public_path('uploads/company'), $favIconName);
            $data->fav_icon = $favIconName;
        }

        if ($request->hasFile('company_logo')) {
            if ($data->company_logo && file_exists(public_path('uploads/company/' . $data->company_logo))) {
                unlink(public_path('uploads/company/' . $data->company_logo));
            }
            $companyLogoName = rand(100000, 999999) . '_company_logo.' . $request->company_logo->extension();
            $request->company_logo->move(public_path('uploads/company'), $companyLogoName);
            $data->company_logo = $companyLogoName;
        }

        if ($request->hasFile('footer_logo')) {
            if ($data->footer_logo && file_exists(public_path('uploads/company/' . $data->footer_logo))) {
                unlink(public_path('uploads/company/' . $data->footer_logo));
            }
            $footerLogoName = rand(100000, 999999) . '_footer_logo.' . $request->footer_logo->extension();
            $request->footer_logo->move(public_path('uploads/company'), $footerLogoName);
            $data->footer_logo = $footerLogoName;
        }

        // --- Save Non-Translatable Fields ---
        $data->email1 = $request->email1;
        $data->email2 = $request->email2;
        $data->phone1 = $request->phone1;
        $data->phone2 = $request->phone2;
        $data->phone3 = $request->phone3;
        $data->phone4 = $request->phone4;
        $data->whatsapp = $request->whatsapp;
        $data->website = $request->website;
        $data->facebook = $request->facebook;
        $data->instagram = $request->instagram;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->youtube = $request->youtube;
        $data->tawkto = $request->tawkto;
        $data->vat_percent = $request->vat_percent;
        $data->google_appstore_link = $request->google_appstore_link;
        $data->google_play_link = $request->google_play_link;
        $data->footer_link = $request->footer_link;
        $data->currency = $request->currency;
        $data->google_map = $request->google_map;
        $data->company_reg_number = $request->company_reg_number;
        $data->vat_number = $request->vat_number;
        $data->opening_time = $request->opening_time;
        $data->account_number = $request->account_number;
        $data->sort_code = $request->sort_code;
        $data->bank = $request->bank;

        // --- Save Translatable Fields (Auto-Translate) ---
        $this->translateAndSet($data, 'company_name', $request->company_name);
        $this->translateAndSet($data, 'business_name', $request->business_name);
        $this->translateAndSet($data, 'address1', $request->address1);
        $this->translateAndSet($data, 'address2', $request->address2);
        $this->translateAndSet($data, 'footer_content', $request->footer_content);

        $data->save();

        return redirect()->back()->with('success', 'Company details updated & auto-translated successfully.');
    }
    /**
     * Show About Us form.
     */
    public function aboutUs()
    {       
        $companyDetails = CompanyDetails::first();
        return view('admin.company.about_us', compact('companyDetails'));
    }

    /**
     * Update About Us.
     */
    public function aboutUsUpdate(Request $request)
    {
        $request->validate([
            'about_us' => 'required|string',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'about_us', $request->about_us);
        $companyDetails->save();

        return redirect()->back()->with('success', 'About us updated & translated successfully.');
    }

    /**
     * Show Privacy Policy form.
     */
    public function privacyPolicy()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.privacy', compact('companyDetails'));
    }

    /**
     * Update Privacy Policy.
     */
    public function privacyPolicyUpdate(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'required|string',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'privacy_policy', $request->privacy_policy);
        $companyDetails->save();

        Cache::forget('company_privacy');

        return redirect()->back()->with('success', 'Privacy policy updated & translated successfully.');
    }

    /**
     * Show Terms and Conditions form.
     */
    public function termsAndConditions()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.terms', compact('companyDetails'));
    }

    /**
     * Update Terms and Conditions.
     */
    public function termsAndConditionsUpdate(Request $request)
    {
        $request->validate([
            'terms_and_conditions' => 'required|string',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'terms_and_conditions', $request->terms_and_conditions);
        $companyDetails->save();

        Cache::forget('company_terms');

        return redirect()->back()->with('success', 'Terms and conditions updated & translated successfully.');
    }

    /**
     * Show Mail Body form.
     */
    public function mailBody()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.mail_body', compact('companyDetails'));
    }

    /**
     * Update Mail Body.
     */
    public function mailBodyUpdate(Request $request)
    {
        $request->validate([
            'mail_body' => 'required',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'mail_body', $request->mail_body);
        $companyDetails->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }

    /**
     * Show Home Footer form.
     */
    public function homeFooter()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.home_footer', compact('companyDetails'));
    }

    /**
     * Update Home Footer.
     */
    public function homeFooterUpdate(Request $request)
    {
        $request->validate([
            'footer_content' => 'required',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'footer_content', $request->footer_content);
        $companyDetails->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }

    /**
     * Show Copyright form.
     */
    public function copyright()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.copyright', compact('companyDetails'));
    }

    /**
     * Update Copyright.
     */
    public function copyrightUpdate(Request $request)
    {
        $request->validate([
            'copyright' => 'required',
        ]);

        $companyDetails = CompanyDetails::first();
        $this->translateAndSet($companyDetails, 'copyright', $request->copyright);
        $companyDetails->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }

    /**
     * Show SEO Meta form.
     */
    public function seoMeta()
    {
        $companyDetails = CompanyDetails::first();
        return view('admin.company.seo-meta', compact('companyDetails'));
    }

    /**
     * Update SEO Meta.
     */
    public function seoMetaUpdate(Request $request)
    {
        $request->validate([
            'google_site_verification' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $companyDetails = CompanyDetails::first();
        if (!$companyDetails) {
            $companyDetails = new CompanyDetails();
        }

        // Non-translatable
        $companyDetails->google_site_verification = $request->google_site_verification;

        // Translatable
        $this->translateAndSet($companyDetails, 'meta_title', $request->meta_title);
        $this->translateAndSet($companyDetails, 'meta_description', $request->meta_description);
        $this->translateAndSet($companyDetails, 'meta_keywords', $request->meta_keywords);

        // Handle meta image upload
        if ($request->hasFile('meta_image')) {
            $metaImage = $request->file('meta_image');
            $metaImageName = 'meta_' . time() . '.webp';
            $path = public_path('uploads/company/meta/');

            // Ensure directory exists
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Delete old image if exists
            if ($companyDetails->meta_image && file_exists($path . $companyDetails->meta_image)) {
                unlink($path . $companyDetails->meta_image);
            }

            // Process and save new image
            Image::make($metaImage)
                ->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 80)
                ->save($path . $metaImageName);

            $companyDetails->meta_image = $metaImageName;
        }

        $companyDetails->save();

        return redirect()->back()->with('success', 'SEO Meta fields updated successfully.');
    }
}