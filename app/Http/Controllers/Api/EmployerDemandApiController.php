<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerDemand;

class EmployerDemandApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'destination_country' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'salary' => 'nullable|string|max:255',
            'accommodation' => 'nullable|string|max:255',
        ]);

        EmployerDemand::create($validated);

        return response()->json([
            'message' => 'Demand request submitted successfully! Our team will contact you soon.'
        ], 201);
    }
}