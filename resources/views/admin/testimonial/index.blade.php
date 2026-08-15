@extends('admin.pages.master')
@section('title', 'Client Reviews & Testimonials')
@section('content')

    <!-- Full Page Loader Overlay -->
    <div id="fullPageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">Add New Review</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Review</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="reviewer_name" name="reviewer_name" placeholder="e.g. Engr. Abdullah Youssef">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Reviewer Role</label>
                                    <input type="text" class="form-control" id="reviewer_role" name="reviewer_role" placeholder="e.g. Project Director, Al Yamama (KSA)">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Review Text <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="review_text" name="review_text" rows="3" placeholder="Eminent International supplied 250 skilled..."></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stars Rating</label>
                                    <select class="form-select" id="stars" name="stars">
                                        <option value="5">5 Stars (Best)</option>
                                        <option value="4">4 Stars (Good)</option>
                                        <option value="3">3 Stars (Average)</option>
                                        <option value="2">2 Stars (Poor)</option>
                                        <option value="1">1 Star (Bad)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Avatar Background Color</label>
                                    <select class="form-select" id="avatar_bg_color" name="avatar_bg_color">
                                        <option value="bg-navy">Navy</option>
                                        <option value="bg-primary">Blue</option>
                                        <option value="bg-danger">Red (Maroon)</option>
                                        <option value="bg-warning text-dark">Yellow (Gold)</option>
                                        <option value="bg-success">Green</option>
                                        <option value="bg-dark">Dark</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
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
            <div class="card-header"><h4 class="card-title mb-0">All Testimonials</h4></div>
            <div class="card-body">
                <table id="testimonialTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Reviewer</th>
                            <th>Role</th>
                            <th>Stars</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#addThisFormContainer").hide();

            $('#testimonialTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('alltestimonial') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'reviewer_name', name: 'reviewer_name' },
                    { data: 'reviewer_role', name: 'reviewer_role' },
                    { data: 'stars_display', name: 'stars_display', orderable: false, searchable: false },
                    { data: 'order', name: 'order' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $("#newBtn").click(function() {
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);
            });

            $("#FormCloseBtn").click(function() {
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            var url = "{{ URL::to('/admin/testimonial') }}";
            var upurl = "{{ URL::to('/admin/testimonial-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("reviewer_name", $("#reviewer_name").val());
                form_data.append("reviewer_role", $("#reviewer_role").val());
                form_data.append("review_text", $("#review_text").val());
                form_data.append("stars", $("#stars").val());
                form_data.append("avatar_bg_color", $("#avatar_bg_color").val());
                form_data.append("order", $("#order").val());

                if ($(this).html() == 'Create') {
                    $.ajax({
                        url: url, method: "POST", contentType: false, processData: false, data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#testimonialTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } 
                            else { showError(xhr.responseJSON?.message ?? "Something went wrong!"); }
                        },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }

                if ($(this).html() == 'Update') {
                    form_data.append("codeid", $("#codeid").val());
                    $.ajax({
                        url: upurl, method: "POST", contentType: false, processData: false, data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#testimonialTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } 
                            else { showError(xhr.responseJSON?.message ?? "Something went wrong!"); }
                        },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Testimonial');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#reviewer_name").val(d.reviewer_name);
                    $("#reviewer_role").val(d.reviewer_role);
                    $("#review_text").val(d.review_text);
                    $("#stars").val(d.stars);
                    $("#avatar_bg_color").val(d.avatar_bg_color);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var testimonial_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/testimonial-status',
                    method: "POST",
                    data: { testimonial_id: testimonial_id, status: status, _token: "{{ csrf_token() }}" },
                    success: function(d) { reloadTable('#testimonialTable'); showSuccess(d.message); },
                    error: function(xhr) { showError('Failed to update status'); }
                });
            });

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Review');
            }
        });
    </script>
@endsection