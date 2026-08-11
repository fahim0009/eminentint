<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::query()->orderBy('id', 'desc');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d M, Y h:i A');
                })
                ->addColumn('name_phone', function ($row) {
                    return '<strong>' . $row->name . '</strong><br><small class="text-muted">' . $row->phone . '</small>';
                })
                ->addColumn('message_details', function ($row) {
                    $subject = $row->subject ? '<strong>Subject:</strong> ' . $row->subject . '<br>' : '';
                    return $subject . '<span class="text-muted small">' . \Str::limit($row->message, 100) . '</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_read 
                        ? '<span class="badge bg-light text-dark">Read</span>' 
                        : '<span class="badge bg-danger text-white">Unread</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button class="dropdown-item viewContactBtn" data-id="'.$row->id.'">
                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View Details
                                    </button>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item deleteBtn" 
                                            data-delete-url="' . route('contact.delete', $row->id) . '" 
                                            data-method="DELETE" 
                                            data-table="#contactTable">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['name_phone', 'message_details', 'status', 'action'])
                ->make(true);
        }

        return view('admin.contact.index');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read when viewed by admin
        if (!$contact->is_read) {
            $contact->is_read = 1;
            $contact->save();
        }

        return response()->json($contact);
    }

    public function delete($id)
    {
        $data = Contact::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Message deleted successfully.'], 200);
    }
}