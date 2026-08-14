<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyLicense;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CompanyLicenseController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $licenses = CompanyLicense::query()->orderBy('order', 'asc');
            
            return DataTables::of($licenses)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<div class="form-check form-switch" dir="ltr">
                                <input type="checkbox" class="form-check-input toggle-status" 
                                      id="customSwitchStatus'.$row->id.'" data-id="'.$row->id.'" '.$checked.'>
                                <label class="form-check-label" for="customSwitchStatus'.$row->id.'"></label>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button class="dropdown-item" id="EditBtn" rid="'.$row->id.'">
                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                    </button>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item deleteBtn" 
                                            data-delete-url="' . route('license.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#licenseTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.license.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'reg_no' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:5120', // Max 5MB PDF
        ]);
        
        $data = new CompanyLicense();
        
        // Non-translatable
        $data->reg_no = $request->reg_no;
        $data->badge_color = $request->badge_color;
        $data->prefix_badge_color = $request->prefix_badge_color;
        $data->border_class = $request->border_class;
        $data->icon_class = $request->icon_class;
        $data->icon_color = $request->icon_color;
        $data->order = $request->order ?? 1;

        // Handle PDF Upload
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . mt_rand(1000, 9999) . '.pdf';
            $file->move(public_path('uploads/licenses/'), $fileName);
            $data->pdf_file = '/uploads/licenses/' . $fileName;
        }

        // Translatable
        $this->translateAndSet($data, 'status_badge', $request->status_badge);
        $this->translateAndSet($data, 'prefix_badge', $request->prefix_badge);
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'reg_detail', $request->reg_detail);

        if ($data->save()) {
            return response()->json(['message' => 'License added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding license.'], 500);
    }

    public function edit($id)
    {
        $info = CompanyLicense::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'reg_no' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = CompanyLicense::findOrFail($request->codeid);
        
        // Non-translatable
        $data->reg_no = $request->reg_no;
        $data->badge_color = $request->badge_color;
        $data->prefix_badge_color = $request->prefix_badge_color;
        $data->border_class = $request->border_class;
        $data->icon_class = $request->icon_class;
        $data->icon_color = $request->icon_color;
        $data->order = $request->order ?? 1;

        // Handle PDF Upload
        if ($request->hasFile('pdf_file')) {
            if ($data->pdf_file && file_exists(public_path($data->pdf_file))) {
                @unlink(public_path($data->pdf_file));
            }
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . mt_rand(1000, 9999) . '.pdf';
            $file->move(public_path('uploads/licenses/'), $fileName);
            $data->pdf_file = '/uploads/licenses/' . $fileName;
        }

        // Translatable
        $this->translateAndSet($data, 'status_badge', $request->status_badge);
        $this->translateAndSet($data, 'prefix_badge', $request->prefix_badge);
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'reg_detail', $request->reg_detail);

        if ($data->save()) {
            return response()->json(['message' => 'License updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update license.'], 500);
    }

    public function delete($id)
    {
        $data = CompanyLicense::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'License not found.'], 404);
        }

        if ($data->pdf_file && file_exists(public_path($data->pdf_file))) {
            @unlink(public_path($data->pdf_file));
        }

        if ($data->delete()) {
            return response()->json(['message' => 'License deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete license.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $license = CompanyLicense::find($request->license_id);

        if (!$license) {
            return response()->json(['message' => 'License not found'], 404);
        }

        $license->status = $request->status;

        if ($license->save()) {
            return response()->json(['message' => 'License status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update license status'], 500);
    }
}