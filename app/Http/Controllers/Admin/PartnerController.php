<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PartnerController extends Controller
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
            $data = Partner::query()->orderBy('order', 'asc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return '<span class="badge bg-light border p-2"><i class="' . ($row->icon_class ?? 'bi-building') . ' fs-5 ' . ($row->icon_color ?? 'text-primary') . '"></i></span>';
                })
                ->addColumn('country_info', function ($row) {
                    return ($row->country_flag ? $row->country_flag . ' ' : '') . $row->country;
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
                                            data-delete-url="' . route('partner.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#partnerTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['icon', 'country_info', 'status', 'action'])
                ->make(true);
        }

        return view('admin.partner.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'country' => 'required|string',
        ]);
        
        $data = new Partner();
        $data->country_flag = $request->country_flag;
        $data->icon_class = $request->icon_class ?? 'bi-building';
        $data->icon_color = $request->icon_color ?? 'text-primary';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'name', $request->name);
        $this->translateAndSet($data, 'country', $request->country);

        if ($data->save()) {
            return response()->json(['message' => 'Partner added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding partner.'], 500);
    }

    public function edit($id)
    {
        $info = Partner::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'country' => 'required|string',
        ]);

        $data = Partner::findOrFail($request->codeid);
        $data->country_flag = $request->country_flag;
        $data->icon_class = $request->icon_class ?? 'bi-building';
        $data->icon_color = $request->icon_color ?? 'text-primary';
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'name', $request->name);
        $this->translateAndSet($data, 'country', $request->country);

        if ($data->save()) {
            return response()->json(['message' => 'Partner updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update partner.'], 500);
    }

    public function delete($id)
    {
        $data = Partner::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Partner not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Partner deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete partner.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $item = Partner::find($request->partner_id);

        if (!$item) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $item->status = $request->status;

        if ($item->save()) {
            return response()->json(['message' => 'Partner status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update partner status'], 500);
    }
}