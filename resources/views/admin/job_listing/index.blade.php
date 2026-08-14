@extends('admin.pages.master')
@section('title', 'Job Listings')
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
                    Add New Job
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Job</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Job Title / Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Barista & Coffee Specialist">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="e.g. Al Falah Hospitality Group KSA">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="country" name="country" placeholder="e.g. Saudi Arabia">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="e.g. Riyadh">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Vacancy Count</label>
                                    <input type="number" class="form-control" id="vacancy_count" name="vacancy_count" placeholder="e.g. 50">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Industry</label>
                                    <input type="text" class="form-control" id="industry" name="industry" placeholder="e.g. Hospitality">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary" placeholder="e.g. 2,200 SAR / Month">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Benefits</label>
                                    <textarea class="form-control" id="benefits" name="benefits" rows="2" placeholder="e.g. Free Food, Accommodation, Transport"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Requirements</label>
                                    <textarea class="form-control" id="requirements" name="requirements" rows="2" placeholder="e.g. 1-2 Years Experience, Basic English"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" id="addBtn" class="btn btn-primary">
                            Create
                        </button>
                        <button type="button" id="FormCloseBtn" class="btn btn-light">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="contentContainer">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Job Listings</h4>
            </div>
            <div class="card-body">
                <table id="jobTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Vacancies</th>
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

            $('#jobTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('alljoblisting') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'location', name: 'location', orderable: false, searchable: false },
                    { data: 'vacancy_count', name: 'vacancy_count' },
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

            var url = "{{ URL::to('/admin/job-listing') }}";
            var upurl = "{{ URL::to('/admin/job-listing-update') }}";

            $("#addBtn").click(function() {
                if ($(this).val() == 'Create' || $(this).html() == 'Create') {
                    var form_data = new FormData();
                    form_data.append("title", $("#title").val());
                    form_data.append("company_name", $("#company_name").val());
                    form_data.append("country", $("#country").val());
                    form_data.append("city", $("#city").val());
                    form_data.append("industry", $("#industry").val());
                    form_data.append("vacancy_count", $("#vacancy_count").val());
                    form_data.append("salary", $("#salary").val());
                    form_data.append("benefits", $("#benefits").val());
                    form_data.append("requirements", $("#requirements").val());

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
                            reloadTable('#jobTable');
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

                if ($(this).val() == 'Update' || $(this).html() == 'Update') {
                    var form_data = new FormData();
                    form_data.append("codeid", $("#codeid").val());
                    form_data.append("title", $("#title").val());
                    form_data.append("company_name", $("#company_name").val());
                    form_data.append("country", $("#country").val());
                    form_data.append("city", $("#city").val());
                    form_data.append("industry", $("#industry").val());
                    form_data.append("vacancy_count", $("#vacancy_count").val());
                    form_data.append("salary", $("#salary").val());
                    form_data.append("benefits", $("#benefits").val());
                    form_data.append("requirements", $("#requirements").val());

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
                            reloadTable('#jobTable');
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
                $("#cardTitle").text('Update this Job');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    populateForm(d);
                    pagetop();
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var job_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/job-listing-status',
                    method: "POST",
                    data: {
                        job_id: job_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#jobTable');
                        showSuccess(d.message);
                    },
                    error: function(xhr) {
                        showError('Failed to update status');
                    }
                });
            });

            function populateForm(data) {
                $("#title").val(data.title);
                $("#company_name").val(data.company_name);
                $("#country").val(data.country);
                $("#city").val(data.city);
                $("#industry").val(data.industry);
                $("#vacancy_count").val(data.vacancy_count);
                $("#salary").val(data.salary);
                $("#benefits").val(data.benefits);
                $("#requirements").val(data.requirements);
                
                $("#codeid").val(data.id);
                $("#addBtn").val('Update');
                $("#addBtn").html('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Job');
            }
        });
    </script>
@endsection