<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkforceStatement;
use Stichoza\GoogleTranslate\GoogleTranslate;

class WorkforceStatementController extends Controller
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
        $data = WorkforceStatement::firstOrCreate(['id' => 1]);
        return view('admin.workforce_statement.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = WorkforceStatement::firstOrCreate(['id' => 1]);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'btn1_text' => 'nullable|string',
            'btn2_text' => 'nullable|string',
        ]);

        $fields = ['title', 'description', 'btn1_text', 'btn2_text'];

        foreach ($fields as $field) {
            $this->translateAndSet($data, $field, $request->$field);
        }

        $data->save();

        return redirect()->back()->with('success', 'Workforce Statement updated & translated successfully.');
    }
}