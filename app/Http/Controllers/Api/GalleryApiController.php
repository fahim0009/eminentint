<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryApiController extends Controller
{
    public function getGalleries(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        // Optional filtering by category_id (e.g. /api/galleries?category_id=1)
        $query = Gallery::with('category')->where('status', 1);

        if ($request->has('category_id')) {
            $query->where('gallery_category_id', $request->category_id);
        }

        $galleries = $query->orderBy('order', 'asc')->get();

        if ($galleries->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No gallery items found.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gallery items retrieved successfully.',
            'data' => $galleries
        ], 200);
    }
}