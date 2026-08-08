@extends('admin.pages.master')
@section('title', 'Countries We Serve')
@section('content')

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">
                    Add New Country
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Country</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Saudi Arabia">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Short Name</label>
                                    <input type="text" class="form-control" id="short_name" name="short_name" placeholder="e.g. KSA">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Flag (Emoji) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="flag" name="flag" placeholder="🇸🇦">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Salary Range</label>
                                    <input type="text" class="form-control" id="salary_range" name="salary_range" placeholder="e.g. 1,500 - 4,500 SAR">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Deployment Time</label>
                                    <input type="text" class="form-control" id="deployment_time" name="deployment_time" placeholder="e.g. 30 - 40 Days">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" placeholder="1">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Short description about the country workforce..."></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Current Demand (Featured Only)</label>
                                    <input type="text" class="form-control" id="current_demand" name="current_demand" placeholder="e.g. 500+ Openings">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Visa Process (Featured Only)</label>
                                    <input type="text" class="form-control" id="visa_process" name="visa_process" placeholder="e.g. MOFA / Enjaz Direct">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Job Filter Link</label>
                                    <input type="text" class="form-control" id="job_link" name="job_link" placeholder="e.g. jobs.html?country=saudi">
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1">
                                        <label class="form-check-label" for="is_featured">Is Featured? (Large Block)</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Featured Image</label>
                                    <input type="file" class="form-control" id="image" accept="image/*" onchange="previewImage(event, '#preview-image')">
                                    <img id="preview-image" src="#" alt="" class="img-thumbnail rounded mt-3" style="max-width: 150px; display: none;">
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
                <h4 class="card-title mb-0">All Countries</h4>
            </div>
            <div class="card-body">
                <table id="countryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Country Name</th>
                            <th>Featured</th>
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

            $('#countryTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allcountry') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'flag_name', name: 'flag_name', orderable: false },
                    { data: 'featured', name: 'featured', orderable: false, searchable: false },
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

            var url = "{{ URL::to('/admin/country') }}";
            var upurl = "{{ URL::to('/admin/country-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("name", $("#name").val());
                form_data.append("short_name", $("#short_name").val());
                form_data.append("flag", $("#flag").val());
                form_data.append("salary_range", $("#salary_range").val());
                form_data.append("deployment_time", $("#deployment_time").val());
                form_data.append("description", $("#description").val());
                form_data.append("current_demand", $("#current_demand").val());
                form_data.append("visa_process", $("#visa_process").val());
                form_data.append("job_link", $("#job_link").val());
                form_data.append("order", $("#order").val());
                
                if ($('#is_featured').is(':checked')) {
                    form_data.append("is_featured", 1);
                }

                var featureImgInput = document.getElementById('image');
                if (featureImgInput.files && featureImgInput.files[0]) {
                    form_data.append("image", featureImgInput.files[0]);
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
                            reloadTable('#countryTable');
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
                            reloadTable('#countryTable');
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
                $("#cardTitle").text('Update this Country');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    populateForm(d);
                    pagetop();
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var country_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/country-status',
                    method: "POST",
                    data: {
                        country_id: country_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#countryTable');
                        showSuccess(d.message);
                    },
                    error: function(xhr) {
                        showError('Failed to update status');
                    }
                });
            });

            function populateForm(data) {
                $("#name").val(data.name);
                $("#short_name").val(data.short_name);
                $("#flag").val(data.flag);
                $("#salary_range").val(data.salary_range);
                $("#deployment_time").val(data.deployment_time);
                $("#description").val(data.description);
                $("#current_demand").val(data.current_demand);
                $("#visa_process").val(data.visa_process);
                $("#job_link").val(data.job_link);
                $("#order").val(data.order);
                
                if(data.is_featured == 1) {
                    $('#is_featured').prop('checked', true);
                } else {
                    $('#is_featured').prop('checked', false);
                }
                
                $("#codeid").val(data.id);
                $("#addBtn").html('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);

                var featureImagePreview = document.getElementById('preview-image');
                if (data.image) {
                    featureImagePreview.src = data.image;
                    featureImagePreview.style.display = 'block';
                } else {
                    featureImagePreview.src = "#";
                    featureImagePreview.style.display = 'none';
                }
            }

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Country');
                $('#preview-image').attr('src', '#').hide();
            }
        });
    </script>
@endsection