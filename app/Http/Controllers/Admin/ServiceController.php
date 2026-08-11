<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ServiceController extends Controller
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
            $data = Service::query()->orderBy('order', 'asc');
            
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
                                            data-delete-url="' . route('service.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#serviceTable">
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

        return view('admin.service.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string',
        ]);
        
        $data = new Service();
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->anchor_id = $request->anchor_id;
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'features', $request->features);

        if ($data->save()) {
            return response()->json(['message' => 'Service added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding service.'], 500);
    }

    public function edit($id)
    {
        $info = Service::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'icon' => 'required|string',
        ]);

        $data = Service::findOrFail($request->codeid);
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->anchor_id = $request->anchor_id;
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);
        $this->translateAndSet($data, 'features', $request->features);

        if ($data->save()) {
            return response()->json(['message' => 'Service updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update service.'], 500);
    }

    public function delete($id)
    {
        $data = Service::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Service not found.'], 404);
        }

        if ($data->delete()) {
            return response()->json(['message' => 'Service deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete service.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $item = Service::find($request->service_id);

        if (!$item) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $item->status = $request->status;

        if ($item->save()) {
            return response()->json(['message' => 'Service status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update service status'], 500);
    }
}