<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Milestone;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class MilestoneController extends Controller
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
            $data = Milestone::query()->orderBy('year', 'asc');
            
            return DataTables::of($data)
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
                                            data-delete-url="' . route('milestone.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#milestoneTable">
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

        return view('admin.milestone.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string',
            'badge_color' => 'nullable|string',
        ]);
        
        $data = new Milestone();
        $data->year = $request->year;
        $data->badge_color = $request->badge_color ?? 'bg-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        if ($data->save()) {
            return response()->json(['message' => 'Milestone added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding milestone.'], 500);
    }

    public function edit($id)
    {
        $info = Milestone::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string',
            'badge_color' => 'nullable|string',
        ]);

        $data = Milestone::findOrFail($request->codeid);
        $data->year = $request->year;
        $data->badge_color = $request->badge_color ?? 'bg-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        if ($data->save()) {
            return response()->json(['message' => 'Milestone updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update milestone.'], 500);
    }

    public function delete($id)
    {
        $data = Milestone::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Milestone not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Milestone deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete milestone.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $item = Milestone::find($request->milestone_id);

        if (!$item) {
            return response()->json(['message' => 'Milestone not found'], 404);
        }

        $item->status = $request->status;

        if ($item->save()) {
            return response()->json(['message' => 'Milestone status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update milestone status'], 500);
    }
}