@extends('admin.pages.master')
@section('title', 'Corporate Track Records')
@section('content')

    <!-- Full Page Loader Overlay -->
    <div id="fullPageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3"><div class="col-auto"><button type="button" class="btn btn-primary" id="newBtn">Add New Record</button></div></div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex"><h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Record</h4></div>
                    <div class="card-body">
                        <form id="createThisForm">@csrf<input type="hidden" id="codeid" name="codeid">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Badge Text</label>
                                    <input type="text" class="form-control" id="badge_text" name="badge_text" placeholder="Confidential Partner — Riyadh">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Company Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Major Saudi Construction Company">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Supplied over 500+ Masons..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Footer Text</label>
                                    <input type="text" class="form-control" id="footer_text" name="footer_text" placeholder="✓ 500+ Workers Deployed">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="1">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" id="addBtn" class="btn btn-primary">Create</button>
                        <button type="button" id="FormCloseBtn" class="btn btn-light">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="contentContainer">
        <div class="card">
            <div class="card-header"><h4 class="card-title mb-0">All Track Records</h4></div>
            <div class="card-body">
                <table id="trackRecordTable" class="table table-bordered table-striped">
                    <thead><tr><th>Sl</th><th>Title</th><th>Footer</th><th>Order</th><th>Status</th><th>Action</th></tr></thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#addThisFormContainer").hide();

            $('#trackRecordTable').DataTable({
                processing: true, serverSide: true, pageLength: 25,
                ajax: "{{ route('alltrackrec') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'footer_text', name: 'footer_text', orderable: false, searchable: false },
                    { data: 'order', name: 'order' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $("#newBtn").click(function() { clearform(); $("#newBtn").hide(100); $("#addThisFormContainer").show(300); });
            $("#FormCloseBtn").click(function() { $("#addThisFormContainer").hide(200); $("#newBtn").show(100); clearform(); });
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            var url = "{{ URL::to('/admin/track-record') }}"; var upurl = "{{ URL::to('/admin/track-record-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("badge_text", $("#badge_text").val());
                form_data.append("title", $("#title").val());
                form_data.append("description", $("#description").val());
                form_data.append("footer_text", $("#footer_text").val());
                form_data.append("order", $("#order").val());

                if ($(this).html() == 'Create') {
                    $.ajax({ url: url, method: "POST", contentType: false, processData: false, data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) { showSuccess(d.message); $("#addThisFormContainer").slideUp(300); setTimeout(() => { $("#newBtn").show(200); }, 300); reloadTable('#trackRecordTable'); clearform(); },
                        error: function(xhr) { if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } else { showError("Something went wrong!"); } },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }
                if ($(this).html() == 'Update') {
                    form_data.append("codeid", $("#codeid").val());
                    $.ajax({ url: upurl, method: "POST", contentType: false, processData: false, data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) { showSuccess(d.message); $("#addThisFormContainer").slideUp(300); setTimeout(() => { $("#newBtn").show(200); }, 300); reloadTable('#trackRecordTable'); clearform(); },
                        error: function(xhr) { if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } else { showError("Something went wrong!"); } },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Record'); codeid = $(this).attr('rid'); info_url = url + '/' + codeid + '/edit';
                $.get(info_url, {}, function(d) {
                    $("#badge_text").val(d.badge_text); $("#title").val(d.title); $("#description").val(d.description); $("#footer_text").val(d.footer_text); $("#order").val(d.order);
                    $("#codeid").val(d.id); $("#addBtn").html('Update'); $("#addThisFormContainer").show(300); $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var track_record_id = $(this).data('id'); var status = $(this).prop('checked') ? 1 : 0;
                $.ajax({ url: '/admin/track-record-status', method: "POST", data: { track_record_id: track_record_id, status: status, _token: "{{ csrf_token() }}" },
                    success: function(d) { reloadTable('#trackRecordTable'); showSuccess(d.message); }, error: function(xhr) { showError('Failed to update status'); }
                });
            });

            function clearform() { $('#createThisForm')[0].reset(); $("#addBtn").html('Create'); $("#cardTitle").text('Add New Record'); }
        });
    </script>
@endsection