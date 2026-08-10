@extends('admin.pages.master')
@section('title', 'Hero Floating Stats')
@section('content')

    <div class="container-fluid" id="newBtnSection">
        <div class="row mb-3">
            <div class="col-auto">
                <button type="button" class="btn btn-primary" id="newBtn">Add New Stat</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Stat</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Icon Class <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="bi-people-fill">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Icon Color</label>
                                    <input type="text" class="form-control" id="icon_color" name="icon_color" placeholder="text-navy" value="text-navy">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="number" name="number" placeholder="10000">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Suffix</label>
                                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder=" +">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="1">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Label (Translated) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="label" name="label" placeholder="Workers Deployed">
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
            <div class="card-header"><h4 class="card-title mb-0">All Stats</h4></div>
            <div class="card-body">
                <table id="heroStatTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Label</th>
                            <th>Number</th>
                            <th>Icon</th>
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

            $('#heroStatTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allherostat') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'label', name: 'label' },
                    { data: 'number', name: 'number' },
                    { data: 'icon', name: 'icon', orderable: false, searchable: false },
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
            var url = "{{ URL::to('/admin/hero-stat') }}";
            var upurl = "{{ URL::to('/admin/hero-stat-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("icon", $("#icon").val());
                form_data.append("icon_color", $("#icon_color").val());
                form_data.append("number", $("#number").val());
                form_data.append("suffix", $("#suffix").val());
                form_data.append("label", $("#label").val());
                form_data.append("order", $("#order").val());

                if ($(this).html() == 'Create') {
                    $.ajax({
                        url: url, method: "POST", contentType: false, processData: false, data: form_data,
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#heroStatTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } 
                            else { showError(xhr.responseJSON?.message ?? "Something went wrong!"); }
                        }
                    });
                }

                if ($(this).html() == 'Update') {
                    form_data.append("codeid", $("#codeid").val());
                    $.ajax({
                        url: upurl, method: "POST", contentType: false, processData: false, data: form_data,
                        success: function(d) {
                            showSuccess(d.message);
                            $("#addThisFormContainer").slideUp(300);
                            setTimeout(() => { $("#newBtn").show(200); }, 300);
                            reloadTable('#heroStatTable');
                            clearform();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) { showError(Object.values(xhr.responseJSON.errors)[0][0]); } 
                            else { showError(xhr.responseJSON?.message ?? "Something went wrong!"); }
                        }
                    });
                }
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Stat');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#icon").val(d.icon);
                    $("#icon_color").val(d.icon_color);
                    $("#number").val(d.number);
                    $("#suffix").val(d.suffix);
                    $("#label").val(d.label);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var hero_stat_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/hero-stat-status',
                    method: "POST",
                    data: { hero_stat_id: hero_stat_id, status: status, _token: "{{ csrf_token() }}" },
                    success: function(d) { reloadTable('#heroStatTable'); showSuccess(d.message); },
                    error: function(xhr) { showError('Failed to update status'); }
                });
            });

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Stat');
            }
        });
    </script>
@endsection