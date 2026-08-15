<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkforceStatement;
use Illuminate\Http\JsonResponse;

class WorkforceStatementApiController extends Controller
{
    public function getWorkforceStatement(): JsonResponse
    {
        $data = WorkforceStatement::first();

        if (!$data) {
            return response()->json(['message' => 'Workforce Statement data not found'], 404);
        }

        return response()->json($data);
    }
}