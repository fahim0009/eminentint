<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class IndustryController extends Controller
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
            $data = Industry::query()->orderBy('order', 'asc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return '<i class="' . ($row->icon ?? 'bi bi-folder') . ' fs-4 ' . ($row->icon_color ?? 'text-navy') . '"></i>';
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
                                            data-delete-url="' . route('industry.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#industryTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['icon', 'status', 'action'])
                ->make(true);
        }

        return view('admin.industry.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        $data = new Industry();
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'button_text', $request->button_text);

        if ($data->save()) {
            return response()->json(['message' => 'Industry added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding industry.'], 500);
    }

    public function edit($id)
    {
        $info = Industry::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string',
        ]);

        $data = Industry::findOrFail($request->codeid);
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'button_text', $request->button_text);

        if ($data->save()) {
            return response()->json(['message' => 'Industry updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update industry.'], 500);
    }

    public function delete($id)
    {
        $data = Industry::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Industry not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Industry deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete industry.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $item = Industry::find($request->industry_id);

        if (!$item) {
            return response()->json(['message' => 'Industry not found'], 404);
        }

        $item->status = $request->status;

        if ($item->save()) {
            return response()->json(['message' => 'Industry status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update industry status'], 500);
    }
}