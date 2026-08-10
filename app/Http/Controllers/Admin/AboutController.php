<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    private function translateAndSet($model, $field, $englishValue)
    {
        $model->setTranslation($field, 'en', $englishValue);
        if (!empty($englishValue)) {
            try {
                $model->setTranslation($field, 'ar', (new GoogleTranslate('ar'))->translate($englishValue));
                $model->setTranslation($field, 'bn', (new GoogleTranslate('bn'))->translate($englishValue));
            } catch (\Exception $e) {
                $model->setTranslation($field, 'ar', $englishValue);
                $model->setTranslation($field, 'bn', $englishValue);
            }
        }
    }

    public function index()
    {
        $data = About::firstOrCreate(['id' => 1]);
        return view('admin.about.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = About::firstOrCreate(['id' => 1]);

        // Non-translatable fields
        $data->stat1_number = $request->stat1_number;
        $data->stat2_number = $request->stat2_number;
        $data->chairman_name = $request->chairman_name;
        $data->chairman_designation = $request->chairman_designation;
        $data->ceo_name = $request->ceo_name;
        $data->ceo_designation = $request->ceo_designation;

        // Handle Images (Company, Chairman, CEO)
        foreach (['company_image', 'chairman_image', 'ceo_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($data->$imageField && file_exists(public_path($data->$imageField))) {
                    @unlink(public_path($data->$imageField));
                }
                $file = $request->file($imageField);
                $fileName = time() . '_' . $imageField . '.webp';
                $destination = public_path('uploads/about/');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                
                Image::make($file)->resize(800, null, fn($c) => $c->aspectRatio())->encode('webp', 50)->save($destination . $fileName);
                $data->$imageField = '/uploads/about/' . $fileName;
            }
        }

        // Translatable fields
        $fields = [
            'hero_title', 'hero_desc', 'company_tag', 'company_title', 'company_content1', 
            'company_content2', 'stat1_label', 'stat2_label', 'mvv_tag', 'mvv_title', 
            'vision_title', 'vision_content', 'mission_title', 'mission_content', 
            'why_title', 'why_content', 'chairman_tag', 'chairman_title', 'chairman_quote',
            'ceo_tag', 'ceo_title', 'ceo_quote', 'timeline_tag', 'timeline_title'
        ];

        foreach ($fields as $field) {
            $this->translateAndSet($data, $field, $request->$field);
        }

        $data->save();
        return redirect()->back()->with('success', 'About page updated & translated successfully.');
    }
}