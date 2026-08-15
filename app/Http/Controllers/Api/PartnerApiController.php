<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;

class PartnerApiController extends Controller
{
    public function getPartners(): JsonResponse
    {
        $data = Partner::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return response()->json($data);
    }
}