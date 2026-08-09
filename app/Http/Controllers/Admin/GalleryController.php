<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GalleryController extends Controller
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
            $items = Gallery::with('category')->orderBy('order', 'asc');
            
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category ? $row->category->name : '<span class="text-muted">None</span>';
                })
                ->addColumn('media', function ($row) {
                    if ($row->media_type == 'image') {
                        return '<img src="'.url($row->media_url).'" class="img-thumbnail" style="max-width: 80px;">';
                    } elseif ($row->media_type == 'youtube') {
                        return '<i class="bi bi-youtube text-danger fs-3"></i>';
                    } else {
                        return '<i class="bi bi-camera-reels-fill text-navy fs-3"></i>';
                    }
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
                    return '<div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown"><i class="ri-more-fill align-middle"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item" id="EditBtn" rid="'.$row->id.'"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</button></li>
                                <li class="dropdown-divider"></li>
                                <li><button class="dropdown-item deleteBtn" data-delete-url="' . route('gallery.delete', $row->id) . '" data-method="DELETE" data-table="#galleryTable"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</button></li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['media', 'category', 'status', 'action'])
                ->make(true);
        }

        $categories = GalleryCategory::where('status', 1)->get();
        return view('admin.gallery.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'media_type' => 'required|in:image,video,youtube',
            'media_file' => 'required_if:media_type,image,video|mimes:jpeg,png,jpg,gif,webp,mp4,mov,webm|max:51200',
            'media_url' => 'required_if:media_type,youtube|string',
        ]);
        
        $data = new Gallery();
        $data->gallery_category_id = $request->gallery_category_id;
        $data->media_type = $request->media_type;
        $data->location = $request->location;
        $data->media_date = $request->media_date;
        $data->order = $request->order ?? 1;

        if ($request->media_type == 'youtube') {
            $data->media_url = $request->media_url;
        } elseif ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
            $destination = public_path('uploads/gallery/');
            if (!file_exists($destination)) mkdir($destination, 0755, true);
            $file->move($destination, $fileName);
            $data->media_url = '/uploads/gallery/' . $fileName;
        }

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        $data->save();
        return response()->json(['message' => 'Gallery item added and translated successfully!'], 200);
    }

    public function edit($id)
    {
        return response()->json(Gallery::findOrFail($id));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'media_type' => 'required|in:image,video,youtube',
            'media_file' => 'nullable_if:media_type,image,video|mimes:jpeg,png,jpg,gif,webp,mp4,mov,webm|max:51200',
            'media_url' => 'nullable_if:media_type,youtube|string',
        ]);

        $data = Gallery::findOrFail($request->codeid);
        $data->gallery_category_id = $request->gallery_category_id;
        $data->media_type = $request->media_type;
        $data->location = $request->location;
        $data->media_date = $request->media_date;
        $data->order = $request->order ?? 1;

        if ($request->media_type == 'youtube') {
            $data->media_url = $request->media_url;
        } elseif ($request->hasFile('media_file')) {
            if ($data->media_url && file_exists(public_path($data->media_url))) {
                @unlink(public_path($data->media_url));
            }
            $file = $request->file('media_file');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
            $file->move(public_path('uploads/gallery/'), $fileName);
            $data->media_url = '/uploads/gallery/' . $fileName;
        }

        $this->translateAndSet($data, 'title', $request->title);
        $this->translateAndSet($data, 'description', $request->description);

        $data->save();
        return response()->json(['message' => 'Gallery item updated successfully!'], 200);
    }

    public function delete($id)
    {
        $data = Gallery::findOrFail($id);
        if ($data->media_url && $data->media_type != 'youtube' && file_exists(public_path($data->media_url))) {
            @unlink(public_path($data->media_url));
        }
        $data->delete();
        return response()->json(['message' => 'Gallery item deleted successfully.'], 200);
    }

    public function toggleStatus(Request $request)
    {
        $item = Gallery::find($request->gallery_id);
        if (!$item) return response()->json(['message' => 'Not found'], 404);
        $item->status = $request->status;
        $item->save();
        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}