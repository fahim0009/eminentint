<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\HeroStat;
use Illuminate\Http\Request;

class HeroApiController extends Controller
{
    /**
     * Get the single Hero Section content.
     */
    public function getHeroSection(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        $hero = HeroSection::first();

        if (!$hero) {
            return response()->json([
                'success' => false,
                'message' => 'Hero section content not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Hero section retrieved successfully.',
            'data' => $hero
        ], 200);
    }

    /**
     * Get all active Hero Stats.
     */
    public function getHeroStats(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }

        $stats = HeroStat::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        if ($stats->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No stats found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Hero stats retrieved successfully.',
            'data' => $stats
        ], 200);
    }
}