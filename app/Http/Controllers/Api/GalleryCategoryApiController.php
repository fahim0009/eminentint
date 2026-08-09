<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryCategoryApiController extends Controller
{
    public function getCategories(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        $categories = GalleryCategory::where('status', 1)
                        ->orderBy('order', 'asc')
                        ->get();

        if ($categories->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No categories found.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gallery categories retrieved successfully.',
            'data' => $categories
        ], 200);
    }
}