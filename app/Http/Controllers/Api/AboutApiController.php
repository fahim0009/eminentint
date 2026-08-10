<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Milestone;
use Illuminate\Http\Request;

class AboutApiController extends Controller
{
    /**
     * Get the single About page content.
     */
    public function getAboutPage(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        $about = About::first();

        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'About page content not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'About page content retrieved successfully.',
            'data' => $about
        ], 200);
    }

    /**
     * Get all active Timeline Milestones.
     */
    public function getMilestones(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        $milestones = Milestone::where('status', 1)
                        ->orderBy('year', 'asc')
                        ->get();

        if ($milestones->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No milestones found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Milestones retrieved successfully.',
            'data' => $milestones
        ], 200);
    }
}