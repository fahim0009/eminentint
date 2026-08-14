<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class JobListingController extends Controller
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
            $jobs = JobListing::query()->orderBy('id', 'desc');
            
            return DataTables::of($jobs)
                ->addIndexColumn()
                ->addColumn('location', function ($row) {
                    return $row->city . ', ' . $row->country;
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
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
                                            data-delete-url="' . route('joblisting.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#jobTable">
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

        return view('admin.job_listing.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'industry' => 'nullable|string',
            'vacancy_count' => 'nullable|integer',
            'company_name' => 'nullable|string',
            'salary' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);
        
        $data = new JobListing();
        
        // Non-translatable
        $data->country = $request->country;
        $data->city = $request->city;
        $data->industry = $request->industry;
        $data->vacancy_count = $request->vacancy_count ?? 1;

        // Translatable
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'company_name', $request->company_name);
        $this->translateAndSet($data, 'salary', $request->salary);
        $this->translateAndSet($data, 'benefits', $request->benefits);
        $this->translateAndSet($data, 'requirements', $request->requirements);

        if ($data->save()) {
            return response()->json(['message' => 'Job created and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while creating job.'], 500);
    }

    public function edit($id)
    {
        $info = JobListing::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'country' => 'required|string',
            'city' => 'nullable|string',
            'industry' => 'nullable|string',
            'vacancy_count' => 'nullable|integer',
            'company_name' => 'nullable|string',
            'salary' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
        ]);

        $data = JobListing::findOrFail($request->codeid);
        
        // Non-translatable
        $data->country = $request->country;
        $data->city = $request->city;
        $data->industry = $request->industry;
        $data->vacancy_count = $request->vacancy_count ?? 1;

        // Translatable
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'company_name', $request->company_name);
        $this->translateAndSet($data, 'salary', $request->salary);
        $this->translateAndSet($data, 'benefits', $request->benefits);
        $this->translateAndSet($data, 'requirements', $request->requirements);

        if ($data->save()) {
            return response()->json(['message' => 'Job updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update job.'], 500);
    }

    public function delete($id)
    {
        $data = JobListing::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Job not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Job deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete job.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $job = JobListing::find($request->job_id);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $job->status = $request->status;

        if ($job->save()) {
            return response()->json(['message' => 'Job status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update job status'], 500);
    }
}