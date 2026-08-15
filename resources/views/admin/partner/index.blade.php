@extends('admin.pages.master')
@section('title', 'Our Trusted Partners')
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
                <button type="button" class="btn btn-primary" id="newBtn">Add New Partner</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Partner</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Partner Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Al Yamama Contracting">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="country" name="country" placeholder="e.g. Saudi Arabia">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Country Flag (Emoji)</label>
                                    <input type="text" class="form-control" id="country_flag" name="country_flag" placeholder="🇸🇦">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Icon Class</label>
                                    <select class="form-select" id="icon_class" name="icon_class">
                                        <option value="bi-building">Building</option>
                                        <option value="bi-cup-hot">Cup Hot (Hospitality)</option>
                                        <option value="bi-tools">Tools</option>
                                        <option value="bi-truck">Truck</option>
                                        <option value="bi-gear-fill">Gear</option>
                                        <option value="bi-airplane">Airplane</option>
                                        <option value="bi-heart-pulse">Heart Pulse</option>
                                        <option value="bi-building-gear">Building Gear</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Icon Color</label>
                                    <select class="form-select" id="icon_color" name="icon_color">
                                        <option value="text-primary">Blue</option>
                                        <option value="text-warning">Yellow</option>
                                        <option value="text-danger">Red</option>
                                        <option value="text-success">Green</option>
                                        <option value="text-info">Cyan</option>
                                        <option value="text-dark">Dark</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
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
            <div class="card-header"><h4 class="card-title mb-0">All Partners</h4></div>
            <div class="card-body">
                <table id="partnerTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Icon</th>
                            <th>Partner Name</th>
                            <th>Country</th>
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

            $('#partnerTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allpartner') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'icon', name: 'icon', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'country_info', name: 'country_info', orderable: false, searchable: false },
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
            var url = "{{ URL::to('/admin/partner') }}";
            var upurl = "{{ URL::to('/admin/partner-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("country", $("#country").val());
                form_data.append("country_flag", $("#country_flag").val());
                form_data.append("icon_class", $("#icon_class").val());
                form_data.append("icon_color", $("#icon_color").val());
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
                            reloadTable('#partnerTable');
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
                            reloadTable('#partnerTable');
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
                $("#cardTitle").text('Update this Partner');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#name").val(d.name);
                    $("#country").val(d.country);
                    $("#country_flag").val(d.country_flag);
                    $("#icon_class").val(d.icon_class);
                    $("#icon_color").val(d.icon_color);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var partner_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/partner-status',
                    method: "POST",
                    data: { partner_id: partner_id, status: status, _token: "{{ csrf_token() }}" },
                    success: function(d) { reloadTable('#partnerTable'); showSuccess(d.message); },
                    error: function(xhr) { showError('Failed to update status'); }
                });
            });

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Partner');
            }
        });
    </script>
@endsection