@extends('admin.pages.master')
@section('title', 'Gallery Items')
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
                <button type="button" class="btn btn-primary" id="newBtn">Add New Media</button>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="addThisFormContainer">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1" id="cardTitle">Add New Media</h4>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" id="codeid" name="codeid">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Electrician Trade Test">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gallery_category_id" name="gallery_category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Media Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="media_type" name="media_type">
                                        <option value="image">📷 Image Photo</option>
                                        <option value="video">🎥 Video File (MP4)</option>
                                        <option value="youtube">▶️ YouTube Link</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="e.g. Dhaka, Bangladesh">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Media Date</label>
                                    <input type="date" class="form-control" id="media_date" name="media_date">
                                </div>
                                
                                <div class="col-md-6" id="url-input-box" style="display: none;">
                                    <label class="form-label">YouTube URL / Video ID</label>
                                    <input type="text" class="form-control" id="media_url" name="media_url" placeholder="e.g. https://youtu.be/dQw4w9WgXcQ">
                                </div>
                                <div class="col-md-6" id="file-input-box">
                                    <label class="form-label">Upload Media File</label>
                                    <input type="file" class="form-control" id="media_file" name="media_file" accept="image/*,video/*">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
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
            <div class="card-header"><h4 class="card-title mb-0">All Gallery Media</h4></div>
            <div class="card-body">
                <table id="galleryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Media</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
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

            // Toggle URL/File inputs based on Media Type
            $('#media_type').change(function() {
                if ($(this).val() == 'youtube') {
                    $('#file-input-box').hide();
                    $('#url-input-box').show();
                } else {
                    $('#url-input-box').hide();
                    $('#file-input-box').show();
                }
            });

            $('#galleryTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: "{{ route('allgallery') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'media', name: 'media', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category', orderable: false, searchable: false },
                    { data: 'media_type', name: 'media_type', orderable: false, searchable: false },
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

            var url = "{{ URL::to('/admin/gallery') }}";
            var upurl = "{{ URL::to('/admin/gallery-update') }}";

            $("#addBtn").click(function() {
                var form_data = new FormData();
                form_data.append("title", $("#title").val());
                form_data.append("gallery_category_id", $("#gallery_category_id").val());
                form_data.append("media_type", $("#media_type").val());
                form_data.append("location", $("#location").val());
                form_data.append("media_date", $("#media_date").val());
                form_data.append("description", $("#description").val());
                form_data.append("order", $("#order").val());

                if ($("#media_type").val() == 'youtube') {
                    form_data.append("media_url", $("#media_url").val());
                } else {
                    var mediaInput = document.getElementById('media_file');
                    if (mediaInput.files && mediaInput.files[0]) {
                        form_data.append("media_file", mediaInput.files[0]);
                    }
                }

                var ajaxUrl = ($(this).html() == 'Create') ? url : upurl;
                if ($(this).html() == 'Update') form_data.append("codeid", $("#codeid").val());

                $.ajax({
                    url: ajaxUrl,
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
                        reloadTable('#galleryTable');
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
            });

            $("#contentContainer").on('click', '#EditBtn', function() {
                $("#cardTitle").text('Update this Media');
                codeid = $(this).attr('rid');
                info_url = url + '/' + codeid + '/edit';
                
                $.get(info_url, {}, function(d) {
                    $("#title").val(d.title);
                    $("#gallery_category_id").val(d.gallery_category_id);
                    $("#media_type").val(d.media_type).trigger('change');
                    if (d.media_type == 'youtube') {
                        $("#media_url").val(d.media_url);
                    }
                    $("#location").val(d.location);
                    $("#media_date").val(d.media_date);
                    $("#description").val(d.description);
                    $("#order").val(d.order);
                    
                    $("#codeid").val(d.id);
                    $("#addBtn").html('Update');
                    $("#addThisFormContainer").show(300);
                    $("#newBtn").hide(100);
                });
            });

            $(document).on('change', '.toggle-status', function() {
                var gallery_id = $(this).data('id');
                var status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    url: '/admin/gallery-status',
                    method: "POST",
                    data: { gallery_id: gallery_id, status: status, _token: "{{ csrf_token() }}" },
                    success: function(d) {
                        reloadTable('#galleryTable');
                        showSuccess(d.message);
                    },
                    error: function() { showError('Failed to update status'); }
                });
            });

            function clearform() {
                $('#createThisForm')[0].reset();
                $("#addBtn").html('Create');
                $("#cardTitle").text('Add New Media');
                $('#media_type').val('image').trigger('change');
            }
        });
    </script>
@endsection