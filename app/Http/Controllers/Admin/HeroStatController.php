<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroStat;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class HeroStatController extends Controller
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
            $data = HeroStat::query()->orderBy('order', 'asc');
            
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
                                            data-delete-url="' . route('herostat.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#heroStatTable">
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

        return view('admin.hero_stat.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string',
            'number' => 'required|string',
            'label' => 'required|string',
        ]);
        
        $data = new HeroStat();
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->number = $request->number;
        $data->suffix = $request->suffix;
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'label', $request->label);

        $data->save();
        return response()->json(['message' => 'Stat added and translated successfully!'], 200);
    }

    public function edit($id)
    {
        return response()->json(HeroStat::findOrFail($id));
    }

    public function update(Request $request)
    {
        $request->validate([
            'icon' => 'required|string',
            'number' => 'required|string',
            'label' => 'required|string',
        ]);

        $data = HeroStat::findOrFail($request->codeid);
        $data->icon = $request->icon;
        $data->icon_color = $request->icon_color ?? 'text-navy';
        $data->number = $request->number;
        $data->suffix = $request->suffix;
        $data->order = $request->order ?? 1;

        $this->translateAndSet($data, 'label', $request->label);

        $data->save();
        return response()->json(['message' => 'Stat updated successfully!'], 200);
    }

    public function delete($id)
    {
        HeroStat::findOrFail($id)->delete();
        return response()->json(['message' => 'Stat deleted successfully.'], 200);
    }

    public function toggleStatus(Request $request)
    {
        $item = HeroStat::find($request->hero_stat_id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);
        $item->status = $request->status;
        $item->save();
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}