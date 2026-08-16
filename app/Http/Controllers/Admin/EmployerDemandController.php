<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerDemand;
use Yajra\DataTables\Facades\DataTables;

class EmployerDemandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployerDemand::query()->orderBy('id', 'desc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M, Y h:i A');
                })
                ->addColumn('company_info', function ($row) {
                    return '<strong>' . $row->company_name . '</strong><br><small class="text-muted">' . $row->contact_person . '</small>';
                })
                ->addColumn('contact_info', function ($row) {
                    return '<a href="tel:'.$row->phone.'">'.$row->phone.'</a><br><small class="text-muted">' . $row->email . '</small>';
                })
                ->addColumn('demand_details', function ($row) {
                    $qty = $row->quantity ? '<span class="badge bg-primary">'.$row->quantity.' Workers</span> ' : '';
                    return $qty . '<span class="text-muted small">' . \Str::limit($row->occupation, 30) . '</span>';
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
                                    <button class="dropdown-item viewDemandBtn" data-id="'.$row->id.'">
                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View Details
                                    </button>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item deleteBtn" 
                                            data-delete-url="' . route('demand.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#demandTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['company_info', 'contact_info', 'demand_details', 'status', 'action'])
                ->make(true);
        }

        return view('admin.employer_demand.index');
    }

    public function show($id)
    {
        $demand = EmployerDemand::findOrFail($id);
        
        // Mark as reviewed when viewed by admin
        if ($demand->status == 'new') {
            $demand->status = 'reviewed';
            $demand->save();
        }

        return response()->json($demand);
    }

    public function delete($id)
    {
        $data = EmployerDemand::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Demand request deleted successfully.'], 200);
    }
}