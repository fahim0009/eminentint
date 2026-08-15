<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TestimonialController extends Controller
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
            $data = Testimonial::query()->orderBy('order', 'asc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('stars_display', function ($row) {
                    $stars = '';
                    for ($i = 1; $i <= 5; $i++) {
                        $color = $i <= $row->stars ? 'text-warning' : 'text-muted';
                        $stars .= '<i class="bi bi-star-fill ' . $color . '"></i>';
                    }
                    return $stars;
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
                                            data-delete-url="' . route('testimonial.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#testimonialTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['stars_display', 'status', 'action'])
                ->make(true);
        }

        return view('admin.testimonial.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviewer_name' => 'required|string',
            'review_text' => 'required|string',
        ]);
        
        $data = new Testimonial();
        $data->stars = $request->stars ?? 5;
        $data->avatar_bg_color = $request->avatar_bg_color ?? 'bg-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'reviewer_name', $request->reviewer_name);
        $this->translateAndSet($data, 'reviewer_role', $request->reviewer_role);
        $this->translateAndSet($data, 'review_text', $request->review_text);

        if ($data->save()) {
            return response()->json(['message' => 'Testimonial added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding testimonial.'], 500);
    }

    public function edit($id)
    {
        $info = Testimonial::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'reviewer_name' => 'required|string',
            'review_text' => 'required|string',
        ]);

        $data = Testimonial::findOrFail($request->codeid);
        $data->stars = $request->stars ?? 5;
        $data->avatar_bg_color = $request->avatar_bg_color ?? 'bg-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'reviewer_name', $request->reviewer_name);
        $this->translateAndSet($data, 'reviewer_role', $request->reviewer_role);
        $this->translateAndSet($data, 'review_text', $request->review_text);

        if ($data->save()) {
            return response()->json(['message' => 'Testimonial updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update testimonial.'], 500);
    }

    public function delete($id)
    {
        $data = Testimonial::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Testimonial not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Testimonial deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete testimonial.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $item = Testimonial::find($request->testimonial_id);

        if (!$item) {
            return response()->json(['message' => 'Testimonial not found'], 404);
        }

        $item->status = $request->status;

        if ($item->save()) {
            return response()->json(['message' => 'Testimonial status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update testimonial status'], 500);
    }
}