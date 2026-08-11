@extends('admin.pages.master')
@section('title', 'Contact Messages')
@section('content')

    <div class="container-fluid" id="contentContainer">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Inbox & Contact Messages</h4>
            </div>
            <div class="card-body">
                <table id="contactTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name & Phone</th>
                            <th>Message</th>
                            <th>Received On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- View Contact Modal -->
    <div class="modal fade" id="viewContactModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white" style="background-color: #113045;">
                    <h5 class="modal-title fw-bold"><i class="bi bi-envelope-open-fill me-2 text-gold"></i> Message Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="contactDetailBody">
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
            $('#contactTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('contacts.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name_phone', name: 'name_phone', orderable: false },
                    { data: 'message_details', name: 'message_details', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            // View Contact Details
            $(document).on('click', '.viewContactBtn', function() {
                var id = $(this).data('id');
                var url = "{{ URL::to('/admin/contact') }}" + '/' + id;
                
                $.get(url, {}, function(d) {
                    var html = `
                        <div class="mb-3">
                            <label class="form-label fw-bold text-navy">From:</label>
                            <p class="form-control-static">${d.name} <small class="text-muted">(${d.user_type || 'N/A'})</small></p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Phone:</label>
                                <p><a href="tel:${d.phone}">${d.phone}</a></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy">Email:</label>
                                <p>${d.email ? '<a href="mailto:'+d.email+'">'+d.email+'</a>' : '<span class="text-muted">Not provided</span>'}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-navy">Subject:</label>
                            <p class="form-control-static">${d.subject || 'No Subject'}</p>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-navy">Message:</label>
                            <p class="p-3 bg-light rounded" style="white-space: pre-wrap;">${d.message}</p>
                        </div>
                    `;
                    $('#contactDetailBody').html(html);
                    $('#viewContactModal').modal('show');
                    
                    // Reload table to update 'Unread' badge to 'Read'
                    reloadTable('#contactTable');
                });
            });
        });
    </script>
@endsection