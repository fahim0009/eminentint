<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DualFeature;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Intervention\Image\Facades\Image;

class DualFeatureController extends Controller
{
    private function translateAndSet($model, $field, $englishValue)
    {
        $englishValue = trim((string)$englishValue);
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
            $model->translateOrNew('ar')->{$field} = $englishValue;
            $model->translateOrNew('bn')->{$field} = $englishValue;
        }
    }

    public function index()
    {
        $data = DualFeature::firstOrCreate(['id' => 1]);
        return view('admin.dual_feature.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = DualFeature::firstOrCreate(['id' => 1]);

        foreach (['employer_image', 'jobseeker_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($data->$imageField && file_exists(public_path($data->$imageField))) {
                    @unlink(public_path($data->$imageField));
                }
                $file = $request->file($imageField);
                $fileName = time() . '_' . $imageField . '.webp';
                $destination = public_path('uploads/dual_feature/');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                
                Image::make($file)->resize(800, null, fn($c) => $c->aspectRatio())->encode('webp', 50)->save($destination . $fileName);
                $data->$imageField = '/uploads/dual_feature/' . $fileName;
            }
        }

        $fields = [
            'employer_tag', 'employer_title', 'employer_desc', 'employer_list', 'employer_btn_text',
            'jobseeker_tag', 'jobseeker_title', 'jobseeker_desc', 'jobseeker_list', 'jobseeker_btn_text'
        ];

        foreach ($fields as $field) {
            $this->translateAndSet($data, $field, $request->$field);
        }

        $data->save();
        return redirect()->back()->with('success', 'Section updated & translated successfully.');
    }
}