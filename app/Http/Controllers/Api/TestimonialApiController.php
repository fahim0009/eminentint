<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class TestimonialApiController extends Controller
{
    public function getTestimonials(): JsonResponse
    {
        $data = Testimonial::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return response()->json($data);
    }
}