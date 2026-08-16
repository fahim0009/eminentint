@extends('admin.pages.master')
@section('title', 'Candidate Applications')
@section('content')

    <div class="container-fluid" id="contentContainer">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Direct Candidate Applications</h4>
            </div>
            <div class="card-body">
                <table id="applicationTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Tracking ID</th>
                            <th>Candidate Name</th>
                            <th>Target Position</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- View Application Modal -->
    <div class="modal fade" id="viewApplicationModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white" style="background-color: #113045;">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-plus me-2 text-gold"></i> Application Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="applicationDetailBody">
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
            $('#applicationTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allapplications') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tracking_id_badge', name: 'tracking_id_badge', orderable: false, searchable: false },
                    { data: 'candidate_info', name: 'candidate_info', orderable: false },
                    { data: 'position_info', name: 'position_info', orderable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // View Application Details
            $(document).on('click', '.viewApplicationBtn', function() {
                var id = $(this).data('id');
                var url = "{{ URL::to('/admin/candidate-application') }}" + '/' + id;
                
                $.get(url, {}, function(d) {
                    
                    // Helper function to generate file links
                    function fileLink(filePath, fileName) {
                        if (!filePath) return '<span class="text-muted">Not Uploaded</span>';
                        return `<a href="${filePath}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-download me-1"></i> ${fileName}</a>`;
                    }

                    var html = `
                        <div class="text-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 fs-5">${d.tracking_id}</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Full Name:</label>
                                <p class="p-2 bg-light rounded">${d.full_name}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Phone / WhatsApp:</label>
                                <p class="p-2 bg-light rounded"><a href="tel:${d.phone}">${d.phone}</a></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Target Position:</label>
                                <p class="p-2 bg-light rounded">${d.target_position}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Passport Number:</label>
                                <p class="p-2 bg-light rounded">${d.passport_number}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Destination:</label>
                                <p class="p-2 bg-light rounded">${d.destination_country || 'N/A'}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Experience Level:</label>
                                <p class="p-2 bg-light rounded">${d.experience_level || 'N/A'}</p>
                            </div>
                            
                            <div class="col-12"><hr class="mt-1"></div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy d-block">Passport Document</label>
                                ${fileLink(d.passport_file, 'View Passport')}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy d-block">CV / Resume</label>
                                ${fileLink(d.cv_file, 'View CV')}
                            </div>
                        </div>
                    `;
                    $('#applicationDetailBody').html(html);
                    $('#viewApplicationModal').modal('show');
                    
                    // Reload table to update 'New' badge to 'Reviewed'
                    reloadTable('#applicationTable');
                });
            });
        });
    </script>
@endsection