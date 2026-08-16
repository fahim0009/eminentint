@extends('admin.pages.master')
@section('title', 'Employer Demand Requests')
@section('content')

    <div class="container-fluid" id="contentContainer">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Employer Demand Requests</h4>
            </div>
            <div class="card-body">
                <table id="demandTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Company & Person</th>
                            <th>Contact</th>
                            <th>Demand Details</th>
                            <th>Received On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- View Demand Modal -->
    <div class="modal fade" id="viewDemandModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white" style="background-color: #113045;">
                    <h5 class="modal-title fw-bold"><i class="bi bi-building me-2 text-gold"></i> Demand Request Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="demandDetailBody">
                    <!-- Filled by JS -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#demandTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('alldemands') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'company_info', name: 'company_info', orderable: false },
                    { data: 'contact_info', name: 'contact_info', orderable: false },
                    { data: 'demand_details', name: 'demand_details', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // View Demand Details
            $(document).on('click', '.viewDemandBtn', function() {
                var id = $(this).data('id');
                var url = "{{ URL::to('/admin/employer-demand') }}" + '/' + id;
                
                $.get(url, {}, function(d) {
                    var html = `
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Company Name:</label>
                                <p class="p-2 bg-light rounded">${d.company_name}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Contact Person:</label>
                                <p class="p-2 bg-light rounded">${d.contact_person}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Phone / WhatsApp:</label>
                                <p class="p-2 bg-light rounded"><a href="tel:${d.phone}">${d.phone}</a></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Email Address:</label>
                                <p class="p-2 bg-light rounded"><a href="mailto:${d.email}">${d.email}</a></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Destination Country:</label>
                                <p class="p-2 bg-light rounded">${d.destination_country || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Required Occupation:</label>
                                <p class="p-2 bg-light rounded">${d.occupation || 'N/A'}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-navy">Worker Quantity:</label>
                                <p class="p-2 bg-light rounded">${d.quantity || 'N/A'}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-navy">Offered Salary:</label>
                                <p class="p-2 bg-light rounded">${d.salary || 'N/A'}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-navy">Accommodation:</label>
                                <p class="p-2 bg-light rounded">${d.accommodation || 'N/A'}</p>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-navy">Submitted On:</label>
                                <p class="text-muted">${new Date(d.created_at).toLocaleString()}</p>
                            </div>
                        </div>
                    `;
                    $('#demandDetailBody').html(html);
                    $('#viewDemandModal').modal('show');
                    
                    // Reload table to update 'New' badge to 'Reviewed'
                    reloadTable('#demandTable');
                });
            });
        });
    </script>
@endsection