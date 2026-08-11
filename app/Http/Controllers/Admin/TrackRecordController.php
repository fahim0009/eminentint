<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackRecord;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TrackRecordController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TrackRecord::query()->orderBy('order', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<div class="form-check form-switch" dir="ltr"><input type="checkbox" class="form-check-input toggle-status" id="customSwitchStatus'.$row->id.'" data-id="'.$row->id.'" '.$checked.'><label class="form-check-label" for="customSwitchStatus'.$row->id.'"></label></div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown"><i class="ri-more-fill align-middle"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><button class="dropdown-item" id="EditBtn" rid="'.$row->id.'"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button></li><li class="dropdown-divider"></li><li><button class="dropdown-item deleteBtn" data-delete-url="' . route('trackrec.delete', $row->id) . '" data-method="DELETE" data-table="#trackRecordTable"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</button></li></ul></div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.track_record.index');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        $data = new TrackRecord();
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'badge_text', $request->badge_text);
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'footer_text', $request->footer_text);

        $data->save();
        return response()->json(['message' => 'Track Record added successfully!'], 200);
    }

    public function edit($id) { return response()->json(TrackRecord::findOrFail($id)); }

    public function update(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        $data = TrackRecord::findOrFail($request->codeid);
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'badge_text', $request->badge_text);
        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'footer_text', $request->footer_text);

        $data->save();
        return response()->json(['message' => 'Track Record updated successfully!'], 200);
    }

    public function delete($id)
    {
        TrackRecord::findOrFail($id)->delete();
        return response()->json(['message' => 'Track Record deleted successfully.'], 200);
    }

    public function toggleStatus(Request $request)
    {
        $item = TrackRecord::find($request->track_record_id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);
        $item->status = $request->status;
        $item->save();
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}