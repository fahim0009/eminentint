<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployerAdvantage;
use App\Models\RecruitmentStep;
use App\Models\TrackRecord;
use Illuminate\Http\Request;

class EmployerZoneApiController extends Controller
{
    /**
     * Helper to set locale.
     */
    private function setLocale(Request $request)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar', 'bn'])) {
            app()->setLocale($request->lang);
        }
    }

    /**
     * Get Employer Advantages (Why Choose Us)
     */
    public function getAdvantages(Request $request)
    {
        $this->setLocale($request);

        $data = EmployerAdvantage::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No advantages found.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employer advantages retrieved successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Get Recruitment Process Steps (Timeline)
     */
    public function getRecruitmentSteps(Request $request)
    {
        $this->setLocale($request);

        $data = RecruitmentStep::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No process steps found.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Recruitment steps retrieved successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Get Corporate Track Records
     */
    public function getTrackRecords(Request $request)
    {
        $this->setLocale($request);

        $data = TrackRecord::where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

        if ($data->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No track records found.'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Track records retrieved successfully.',
            'data' => $data
        ], 200);
    }
}