<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
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
            $categories = GalleryCategory::query()->orderBy('order', 'asc');
            
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return '<i class="' . ($row->icon_class ?? 'bi bi-folder') . ' fs-4 text-navy"></i>';
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
                                            data-delete-url="' . route('gallerycat.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#galleryCategoryTable">
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

        return view('admin.gallery_category.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon_class' => 'nullable|string',
        ]);
        
        $data = new GalleryCategory();
        $data->icon_class = $request->icon_class ?? 'bi bi-folder';
        $data->slug = Str::slug($request->name);
        $data->order = $request->order ?? 1;

        // Translatable
        $this->translateAndSet($data, 'name', $request->name);

        if ($data->save()) {
            return response()->json(['message' => 'Category added and translated successfully!'], 200);
        }

        return response()->json(['message' => 'Server error while adding category.'], 500);
    }

    public function edit($id)
    {
        $info = GalleryCategory::findOrFail($id);
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon_class' => 'nullable|string',
        ]);

        $data = GalleryCategory::findOrFail($request->codeid);
        $data->icon_class = $request->icon_class ?? 'bi bi-folder';
        $data->slug = Str::slug($request->name);
        $data->order = $request->order ?? 1;

        // Translatable
        $this->translateAndSet($data, 'name', $request->name);

        if ($data->save()) {
            return response()->json(['message' => 'Category updated successfully!'], 200);
        }

        return response()->json(['message' => 'Failed to update category.'], 500);
    }

    public function delete($id)
    {
        $data = GalleryCategory::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Category not found.'], 404);
        }

        // Note: Galleries attached to this category will be cascade deleted based on migration setup
        if ($data->delete()) {
            return response()->json(['message' => 'Category deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Failed to delete category.'], 500);
    }

    public function toggleStatus(Request $request)
    {
        $category = GalleryCategory::find($request->category_id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->status = $request->status;

        if ($category->save()) {
            return response()->json(['message' => 'Category status updated successfully'], 200);
        }

        return response()->json(['message' => 'Failed to update category status'], 500);
    }
}