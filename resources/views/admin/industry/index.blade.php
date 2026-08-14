@extends('admin.pages.master')
@section('title', 'Industries We Supply')
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
                <button type="button" class="btn btn-primary" id="newBtn">
                    Add New Industry
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Industry</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Industry Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Construction & Engineering">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="1">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Bootstrap Icon Class <span class="text-danger">*</span></label>
                                    <select class="form-select" id="icon" name="icon">
                                        <option value="bi-building">Building</option>
                                        <option value="bi-bricks">Bricks (Construction)</option>
                                        <option value="bi-hammer">Hammer</option>
                                        <option value="bi-tools">Tools</option>
                                        <option value="bi-cup-hot">Cup Hot (Hospitality)</option>
                                        <option value="bi-truck">Truck (Logistics)</option>
                                        <option value="bi-heart-pulse">Heart Pulse (Medical)</option>
                                        <option value="bi-clipboard-heart">Clipboard (Caregiver)</option>
                                        <option value="bi-shop">Shop (Retail)</option>
                                        <option value="bi-controller">Controller (Entertainment)</option>
                                        <option value="bi-laptop">Laptop (IT)</option>
                                        <option value="bi-gear-fill">Gear (Engineering)</option>
                                        <option value="bi-person-gear">Person Gear (Skilled Labor)</option>
                                        <option value="bi-egg-fried">Egg Fried (Food Service)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Icon Color</label>
                                    <select class="form-select" id="icon_color" name="icon_color">
                                        <option value="text-navy">Navy</option>
                                        <option value="text-primary">Blue (Primary)</option>
                                        <option value="text-success">Green (Success)</option>
                                        <option value="text-danger">Red (Danger)</option>
                                        <option value="text-warning">Yellow (Warning)</option>
                                        <option value="text-info">Cyan (Info)</option>
                                        <option value="text-secondary">Gray (Secondary)</option>
                                        <option value="text-dark">Dark (Black)</option>
                                        <option value="text-muted">Muted (Light Gray)</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Electricians, Plumbers, Masons, Carpenters, Welders..."></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text" placeholder="e.g. Request Construction Staff">
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
            <div class="card-header">
                <h4 class="card-title mb-0">All Industries</h4>
            </div>
            <div class="card-body">
                <table id="industryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Icon</th>
                            <th>Title</th>
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

            $('#industryTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allindustry') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'icon', name: 'icon', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
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

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            var url = "{{ URL::to('/admin/industry') }}";
            var upurl = "{{ URL::to('/admin/industry-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("title", $("#title").val());
                form_data.append("icon", $("#icon").val());
                form_data.append("icon_color", $("#icon_color").val());
                form_data.append("description", $("#description").val());
                form_data.append("button_text", $("#button_text").val());
                form_data.append("order", $("#order").val());

                if ($(this).html() == 'Create') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#industryTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                showError(firstError);
                            } else {
                                showError(xhr.responseJSON?.message ?? "Something went wrong!");
                            }
                        },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }

                if ($(this).html() == 'Update') {
                    form_data.append("codeid", $("#codeid").val());
                    $.ajax({
                        url: upurl,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        data: form_data,
                        beforeSend: function() {
                            $("#fullPageLoader").css("display", "flex");
                        },
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#industryTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                showError(firstError);
                            } else {
                                showError(xhr.responseJSON?.message ?? "Something went wrong!");
                            }
                        },
                        complete: function() {
                            $("#fullPageLoader").hide();
                        }
                    });
                }
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Industry');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#title").val(d.title);
                    $("#icon").val(d.icon);
                    $("#icon_color").val(d.icon_color);
                    $("#description").val(d.description);
                    $("#button_text").val(d.button_text);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var industry_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/industry-status',
                    method: "POST",
                    data: {
                        industry_id: industry_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#industryTable');
                        showSuccess(d.message);
                    },
                    error: function(xhr) {
                        showError('Failed to update status');
                    }
                });
            });

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Industry');
            }
        });
    </script>
@endsection