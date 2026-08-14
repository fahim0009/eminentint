<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Intervention\Image\Facades\Image;

class CountryController extends Controller
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
            $countries = Country::query()->orderBy('order', 'asc');
            
            return DataTables::of($countries)
                ->addIndexColumn()
                ->addColumn('flag_name', function ($row) {
                    return '<span style="font-size: 1.5rem;">'.$row->flag.'</span> ' . $row->name;
                })
                ->addColumn('featured', function ($row) {
                    return $row->is_featured ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>';
                })
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
                                            data-delete-url="' . route('country.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#countryTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['flag_name', 'featured', 'status', 'action'])
                ->make(true);
        }

        return view('admin.country.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'flag' => 'required|string',
            'salary_range' => 'nullable|string',
            'deployment_time' => 'nullable|string',
            'is_featured' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $data = new Country();
        
        // Non-translatable
        $data->flag = $request->flag;
        $data->salary_range = $request->salary_range;
        $data->deployment_time = $request->deployment_time;
        $data->is_featured = $request->has('is_featured') ? 1 : 0;
        $data->order = $request->order ?? 1;

        // Handle Image Upload (For Featured Countries)
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $randomName = mt_rand(10000000, 99999999) . '.webp';
            $destinationPath = public_path('uploads/country/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            Image::make($uploadedFile)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 50)
                ->save($destinationPath . $randomName);

            $data->image = '/uploads/country/' . $randomName;
        }

        // Translatable
        $this->translateAndSet($data, 'name', $request->name);
        $this->translateAndSet($data, 'short_name', $request->short_name);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'current_demand', $request->current_demand);
        $this->translateAndSet($data, 'visa_process', $request->visa_process);
        $this->translateAndSet($data, 'job_link', $request->job_link);

        if ($data->save()) {
            return response()->json(['message' => 'Country added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding country.'], 500);
    }

    public function edit($id)
    {
        $info = Country::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'flag' => 'required|string',
            'salary_range' => 'nullable|string',
            'deployment_time' => 'nullable|string',
            'is_featured' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = Country::findOrFail($request->codeid);
        
        // Non-translatable
        $data->flag = $request->flag;
        $data->salary_range = $request->salary_range;
        $data->deployment_time = $request->deployment_time;
        $data->is_featured = $request->has('is_featured') ? 1 : 0;
        $data->order = $request->order ?? 1;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            if ($data->image && file_exists(public_path($data->image))) {
                @unlink(public_path($data->image));
            }

            $uploadedFile = $request->file('image');
            $randomName = mt_rand(10000000, 99999999) . '.webp';
            $destinationPath = public_path('uploads/country/');

            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);

            Image::make($uploadedFile)
                ->resize(800, null, fn($c) => $c->aspectRatio())
                ->encode('webp', 50)
                ->save($destinationPath . $randomName)
                ->destroy();

            $data->image = '/uploads/country/' . $randomName;
        }

        // Translatable
        $this->translateAndSet($data, 'name', $request->name);
        $this->translateAndSet($data, 'short_name', $request->short_name);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'current_demand', $request->current_demand);
        $this->translateAndSet($data, 'visa_process', $request->visa_process);
        $this->translateAndSet($data, 'job_link', $request->job_link);

        if ($data->save()) {
            return response()->json(['message' => 'Country updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update country.'], 500);
    }

    public function delete($id)
    {
        $data = Country::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Country not found.'], 404);
        }

        if ($data->image && file_exists(public_path($data->image))) {
            @unlink(public_path($data->image));
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Country deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete country.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $country = Country::find($request->country_id);

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        $country->status = $request->status;

        if ($country->save()) {
            return response()->json(['message' => 'Country status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update country status'], 500);
    }
}