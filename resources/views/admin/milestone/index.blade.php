@extends('admin.pages.master')
@section('title', 'Company Timeline / Milestones')
@section('content')

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">
                    Add New Milestone
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Milestone</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Year <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="year" name="year" placeholder="e.g. 2026">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Saudi Licensed Company">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Badge Color</label>
                                    <input type="text" class="form-control" id="badge_color" name="badge_color" placeholder="e.g. bg-success">
                                    <small class="text-muted">Bootstrap classes (bg-navy, bg-maroon, bg-gold, bg-success)</small>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Obtained official Saudi CR and Trading License for direct staffing."></textarea>
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
            <div class="card-header">
                <h4 class="card-title mb-0">All Milestones</h4>
            </div>
            <div class="card-body">
                <table id="milestoneTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Badge Color</th>
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

            $('#milestoneTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allmilestone') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'year', name: 'year' },
                    { data: 'title', name: 'title' },
                    { data: 'badge_color', name: 'badge_color', orderable: false, searchable: false },
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

            var url = "{{ URL::to('/admin/milestone') }}";
            var upurl = "{{ URL::to('/admin/milestone-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("year", $("#year").val());
                form_data.append("title", $("#title").val());
                form_data.append("badge_color", $("#badge_color").val());
                form_data.append("description", $("#description").val());
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
                            reloadTable('#milestoneTable');
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
                            reloadTable('#milestoneTable');
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
                $("#cardTitle").text('Update this Milestone');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#year").val(d.year);
                    $("#title").val(d.title);
                    $("#badge_color").val(d.badge_color);
                    $("#description").val(d.description);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var milestone_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/milestone-status',
                    method: "POST",
                    data: {
                        milestone_id: milestone_id,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(d) {
                        reloadTable('#milestoneTable');
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
                $("#cardTitle").text('Add New Milestone');
            }
        });
    </script>
@endsection