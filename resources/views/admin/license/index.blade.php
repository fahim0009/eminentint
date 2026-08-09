@extends('admin.pages.master')
@section('title', 'Government Licenses')
@section('content')

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">
                    Add New License
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New License</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Recruiting License (RL-1842)">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Registration No</label>
                                    <input type="text" class="form-control" id="reg_no" name="reg_no" placeholder="e.g. RL-1842">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status Badge Text</label>
                                    <input type="text" class="form-control" id="status_badge" name="status_badge" placeholder="e.g. Active, Saudi Verified">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Prefix Badge Text</label>
                                    <input type="text" class="form-control" id="prefix_badge" name="prefix_badge" placeholder="e.g. Bangladesh Govt Approved">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2" placeholder="Issued by Ministry of Expatriates' Welfare..."></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Registration Detail (Below Icon)</label>
                                    <input type="text" class="form-control" id="reg_detail" name="reg_detail" placeholder="e.g. Issued for International Staff Deployment">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status Badge Color</label>
                                    <input type="text" class="form-control" id="badge_color" name="badge_color" placeholder="bg-success">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Prefix Badge Color</label>
                                    <input type="text" class="form-control" id="prefix_badge_color" name="prefix_badge_color" placeholder="bg-navy">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Border Class (Optional)</label>
                                    <input type="text" class="form-control" id="border_class" name="border_class" placeholder="border-start border-4 border-success">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Icon Class</label>
                                    <input type="text" class="form-control" id="icon_class" name="icon_class" placeholder="bi-file-earmark-pdf-fill">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Icon Color</label>
                                    <input type="text" class="form-control" id="icon_color" name="icon_color" placeholder="text-maroon">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" placeholder="1">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Upload PDF Certificate</label>
                                    <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept="application/pdf">
                                    <small class="text-muted">Leave empty to keep existing PDF.</small>
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
                <h4 class="card-title mb-0">All Licenses & Certifications</h4>
            </div>
            <div class="card-body">
                <table id="licenseTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Reg. No</th>
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

            $('#licenseTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('alllicense') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'reg_no', name: 'reg_no' },
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

            var url = "{{ URL::to('/admin/company-license') }}";
            var upurl = "{{ URL::to('/admin/company-license-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("title", $("#title").val());
                form_data.append("reg_no", $("#reg_no").val());
                form_data.append("status_badge", $("#status_badge").val());
                form_data.append("prefix_badge", $("#prefix_badge").val());
                form_data.append("description", $("#description").val());
                form_data.append("reg_detail", $("#reg_detail").val());
                form_data.append("badge_color", $("#badge_color").val());
                form_data.append("prefix_badge_color", $("#prefix_badge_color").val());
                form_data.append("border_class", $("#border_class").val());
                form_data.append("icon_class", $("#icon_class").val());
                form_data.append("icon_color", $("#icon_color").val());
                form_data.append("order", $("#order").val());

                var pdfInput = document.getElementById('pdf_file');
                if (pdfInput.files && pdfInput.files[0]) {
                    form_data.append("pdf_file", pdfInput.files[0]);
                }

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
                            reloadTable('#licenseTable');
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
                            reloadTable('#licenseTable');
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
                $("#cardTitle").text('Update this License');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    populateForm(d);
                    pagetop();
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var license_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/company-license-status',
                    method: "POST",
                    data: {
                        license_id: license_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#licenseTable');
                        showSuccess(d.message);
                    },
                    error: function(xhr) {
                        showError('Failed to update status');
                    }
                });
            });

            function populateForm(data) {
                $("#title").val(data.title);
                $("#reg_no").val(data.reg_no);
                $("#status_badge").val(data.status_badge);
                $("#prefix_badge").val(data.prefix_badge);
                $("#description").val(data.description);
                $("#reg_detail").val(data.reg_detail);
                $("#badge_color").val(data.badge_color);
                $("#prefix_badge_color").val(data.prefix_badge_color);
                $("#border_class").val(data.border_class);
                $("#icon_class").val(data.icon_class);
                $("#icon_color").val(data.icon_color);
                $("#order").val(data.order);
                
                $("#codeid").val(data.id);
                $("#addBtn").html('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New License');
            }
        });
    </script>
@endsection