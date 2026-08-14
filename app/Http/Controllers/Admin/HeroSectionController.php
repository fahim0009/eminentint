<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Intervention\Image\Facades\Image;

class HeroSectionController extends Controller
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

    public function index()
    {
        $data = HeroSection::firstOrCreate(['id' => 1]);
        return view('admin.hero.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = HeroSection::firstOrCreate(['id' => 1]);

        // Non-translatable fields (Icons)
        $data->badge1_icon = $request->badge1_icon;
        $data->badge2_icon = $request->badge2_icon;

        // Handle Collage Images
        foreach (['image1', 'image2', 'image3', 'image4'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($data->$imageField && file_exists(public_path($data->$imageField))) {
                    @unlink(public_path($data->$imageField));
                }
                $file = $request->file($imageField);
                $fileName = time() . '_' . $imageField . '.webp';
                $destination = public_path('uploads/hero/');
                if (!file_exists($destination)) mkdir($destination, 0755, true);
                
                Image::make($file)->resize(800, null, fn($c) => $c->aspectRatio())->encode('webp', 50)->save($destination . $fileName);
                $data->$imageField = '/uploads/hero/' . $fileName;
            }
        }

        // Translatable fields
        $fields = ['title', 'subtitle', 'badge1_text', 'badge2_text', 'btn1_text', 'btn2_text', 'btn3_text'];
        foreach ($fields as $field) {
            $this->translateAndSet($data, $field, $request->$field);
        }

        $data->save();
        return redirect()->back()->with('success', 'Hero Section updated & translated successfully.');
    }
}