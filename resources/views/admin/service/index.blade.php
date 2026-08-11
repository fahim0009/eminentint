@extends('admin.pages.master')
@section('title', 'Services Management')
@section('content')

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">
                    Add New Service
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Service</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Service Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Permanent Recruitment">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="1">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">Anchor ID (For URL)</label>
                                    <input type="text" class="form-control" id="anchor_id" name="anchor_id" placeholder="e.g. permanent">
                                    <small class="text-muted">Used for menu links like services.html#permanent</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bootstrap Icon Class <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g. bi-person-fill-check">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Icon Color</label>
                                    <input type="text" class="form-control" id="icon_color" name="icon_color" placeholder="e.g. text-navy" value="text-navy">
                                    <small class="text-muted">text-navy, text-gold, text-maroon</small>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control summernote" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Features List (Checklist)</label>
                                    <textarea class="form-control summernote" id="features" name="features" rows="4"></textarea>
                                    <small class="text-muted">Use bullet list tool in summernote to create &lt;ul&gt;&lt;li&gt; items.</small>
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
                <h4 class="card-title mb-0">All Services</h4>
            </div>
            <div class="card-body">
                <table id="serviceTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Anchor ID</th>
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

            // Initialize Summernote
            $('.summernote').summernote({
                height: 150,
                tabsize: 2,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#serviceTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allservice') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'icon', name: 'icon', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'anchor_id', name: 'anchor_id' },
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

            var url = "{{ URL::to('/admin/service') }}";
            var upurl = "{{ URL::to('/admin/service-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("title", $("#title").val());
                form_data.append("icon", $("#icon").val());
                form_data.append("icon_color", $("#icon_color").val());
                form_data.append("anchor_id", $("#anchor_id").val());
                form_data.append("description", $("#description").summernote('code'));
                form_data.append("features", $("#features").summernote('code'));
                form_data.append("order", $("#order").val());

                if ($(this).html() == 'Create') {
                    $.ajax({
                        url: url,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#serviceTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                showError(firstError);
                            } else {
                                showError(xhr.responseJSON?.message ?? "Something went wrong!");
                            }
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
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#serviceTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let firstError = Object.values(xhr.responseJSON.errors)[0][0];
                                showError(firstError);
                            } else {
                                showError(xhr.responseJSON?.message ?? "Something went wrong!");
                            }
                        }
                    });
                }
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Service');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#title").val(d.title);
                    $("#icon").val(d.icon);
                    $("#icon_color").val(d.icon_color);
                    $("#anchor_id").val(d.anchor_id);
                    $("#order").val(d.order);
                    
                    // Set Summernote content
                    $("#description").summernote('code', d.description);
                    $("#features").summernote('code', d.features);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var service_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/service-status',
                    method: "POST",
                    data: {
                        service_id: service_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#serviceTable');
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
                $("#cardTitle").text('Add New Service');
                // Clear summernote
                $("#description").summernote('code', '');
                $("#features").summernote('code', '');
            }
        });
    </script>
@endsection