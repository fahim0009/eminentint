<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateApplication;
use Yajra\DataTables\Facades\DataTables;

class CandidateApplicationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CandidateApplication::query()->orderBy('id', 'desc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M, Y h:i A');
                })
                ->addColumn('candidate_info', function ($row) {
                    return '<strong>' . $row->full_name . '</strong><br><small class="text-muted">' . $row->phone . '</small>';
                })
                ->addColumn('tracking_id_badge', function ($row) {
                    return '<span class="badge bg-primary bg-opacity-10 text-primary">' . $row->tracking_id . '</span>';
                })
                ->addColumn('position_info', function ($row) {
                    $html = '<span class="fw-bold text-navy">' . $row->target_position . '</span>';
                    if ($row->destination_country) {
                        $html .= '<br><small class="text-muted">📍 ' . $row->destination_country . '</small>';
                    }
                    return $html;
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 'new' 
                        ? '<span class="badge bg-danger text-white">New</span>' 
                        : '<span class="badge bg-light text-dark">'.ucfirst($row->status).'</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button class="dropdown-item viewApplicationBtn" data-id="'.$row->id.'">
                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View Details
                                    </button>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item deleteBtn" 
                                            data-delete-url="' . route('application.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#applicationTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['candidate_info', 'tracking_id_badge', 'position_info', 'status', 'action'])
                ->make(true);
        }

        return view('admin.candidate_application.index');
    }

    public function show($id)
    {
        $application = CandidateApplication::findOrFail($id);
        
        // Mark as reviewed when viewed by admin
        if ($application->status == 'new') {
            $application->status = 'reviewed';
            $application->save();
        }

        return response()->json($application);
    }

    public function delete($id)
    {
        $data = CandidateApplication::findOrFail($id);
        
        // Optional: Delete files from server to save space
        if ($data->passport_file && file_exists(public_path($data->passport_file))) {
            @unlink(public_path($data->passport_file));
        }
        if ($data->cv_file && file_exists(public_path($data->cv_file))) {
            @unlink(public_path($data->cv_file));
        }

        $data->delete();

        return response()->json(['message' => 'Application deleted successfully.'], 200);
    }
}