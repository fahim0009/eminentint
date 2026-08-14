<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerAdvantage;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class EmployerAdvantageController extends Controller
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
            $data = EmployerAdvantage::query()->orderBy('order', 'asc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return '<i class="' . ($row->icon ?? 'bi bi-shield-check') . ' fs-4 ' . ($row->icon_color ?? 'text-navy') . '"></i>';
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<div class="form-check form-switch" dir="ltr"><input type="checkbox" class="form-check-input toggle-status" id="customSwitchStatus'.$row->id.'" data-id="'.$row->id.'" '.$checked.'><label class="form-check-label" for="customSwitchStatus'.$row->id.'"></label></div>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown"><i class="ri-more-fill align-middle"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><button class="dropdown-item" id="EditBtn" rid="'.$row->id.'"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button></li><li class="dropdown-divider"></li><li><button class="dropdown-item deleteBtn" data-delete-url="' . route('empladv.delete', $row->id) . '" data-method="DELETE" data-table="#employerAdvantageTable"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</button></li></ul></div>';
                })
                ->rawColumns(['icon', 'status', 'action'])
                ->make(true);
        }
        return view('admin.employer_advantage.index');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string', 'icon' => 'required|string']);
        $data = new EmployerAdvantage();
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        $data->save();
        return response()->json(['message' => 'Advantage added successfully!'], 200);
    }

    public function edit($id) { return response()->json(EmployerAdvantage::findOrFail($id)); }

    public function update(Request $request)
    {
        $request->validate(['title' => 'required|string', 'icon' => 'required|string']);
        $data = EmployerAdvantage::findOrFail($request->codeid);
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        $data->save();
        return response()->json(['message' => 'Advantage updated successfully!'], 200);
    }

    public function delete($id)
    {
        EmployerAdvantage::findOrFail($id)->delete();
        return response()->json(['message' => 'Advantage deleted successfully.'], 200);
    }

    public function toggleStatus(Request $request)
    {
        $item = EmployerAdvantage::find($request->employer_advantage_id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);
        $item->status = $request->status;
        $item->save();
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}