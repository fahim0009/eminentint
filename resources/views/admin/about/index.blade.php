@extends('admin.pages.master')
@section('title', 'About Page Management')
@section('content')

    <!-- Full Page Loader Overlay -->
    <div id="fullPageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">

                @if (session()->has('success'))
                    <div class="alert alert-success pt-3 mb-3">{{ session()->get('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header"><h3 class="card-title mb-0">About Page Content</h3></div>
                    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" id="aboutForm">
                        @csrf
                        <div class="card-body">
                            <h5 class="text-navy mb-3 border-bottom pb-2">Hero Section</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Hero Title</label>
                                    <input type="text" class="form-control" name="hero_title" value="{{ $data->hero_title }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Hero Description</label>
                                    <textarea class="form-control" name="hero_desc" rows="2">{{ $data->hero_desc }}</textarea>
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">Company Section</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Company Tag</label>
                                    <input type="text" class="form-control" name="company_tag" value="{{ $data->company_tag }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Company Title</label>
                                    <input type="text" class="form-control" name="company_title" value="{{ $data->company_title }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Company Content Paragraph 1</label>
                                    <textarea class="form-control summernote" name="company_content1" rows="3">{!! $data->company_content1 !!}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Company Content Paragraph 2</label>
                                    <textarea class="form-control summernote" name="company_content2" rows="3">{!! $data->company_content2 !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stat 1 Number</label>
                                    <input type="text" class="form-control" name="stat1_number" value="{{ $data->stat1_number }}" placeholder="10,000+">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stat 1 Label</label>
                                    <input type="text" class="form-control" name="stat1_label" value="{{ $data->stat1_label }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stat 2 Number</label>
                                    <input type="text" class="form-control" name="stat2_number" value="{{ $data->stat2_number }}" placeholder="500+">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Stat 2 Label</label>
                                    <input type="text" class="form-control" name="stat2_label" value="{{ $data->stat2_label }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Company Image</label>
                                    <input type="file" class="form-control" name="company_image" accept="image/*">
                                    @if($data->company_image) <img src="{{ asset($data->company_image) }}" class="img-thumbnail mt-2" style="max-width:150px"> @endif
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">Mission, Vision & Why Us</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">MVV Tag</label>
                                    <input type="text" class="form-control" name="mvv_tag" value="{{ $data->mvv_tag }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">MVV Title</label>
                                    <input type="text" class="form-control" name="mvv_title" value="{{ $data->mvv_title }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Vision Title</label>
                                    <input type="text" class="form-control" name="vision_title" value="{{ $data->vision_title }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Vision Content</label>
                                    <textarea class="form-control summernote" name="vision_content" rows="2">{!! $data->vision_content !!}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Mission Title</label>
                                    <input type="text" class="form-control" name="mission_title" value="{{ $data->mission_title }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Mission Content</label>
                                    <textarea class="form-control summernote" name="mission_content" rows="2">{!! $data->mission_content !!}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Why Us Title</label>
                                    <input type="text" class="form-control" name="why_title" value="{{ $data->why_title }}">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Why Us Content (List)</label>
                                    <textarea class="form-control summernote" name="why_content" rows="4">{!! $data->why_content !!}</textarea>
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">Chairman & CEO Messages</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6 border-end pe-4">
                                    <h6 class="text-maroon">Chairman</h6>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Image</label>
                                        <input type="file" class="form-control" name="chairman_image" accept="image/*">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Name</label>
                                        <input type="text" class="form-control" name="chairman_name" value="{{ $data->chairman_name }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Designation</label>
                                        <input type="text" class="form-control" name="chairman_designation" value="{{ $data->chairman_designation }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Tag</label>
                                        <input type="text" class="form-control" name="chairman_tag" value="{{ $data->chairman_tag }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Title</label>
                                        <input type="text" class="form-control" name="chairman_title" value="{{ $data->chairman_title }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">Chairman Quote</label>
                                        <textarea class="form-control summernote" name="chairman_quote" rows="3">{!! $data->chairman_quote !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 ps-4">
                                    <h6 class="text-maroon">CEO / Managing Director</h6>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Image</label>
                                        <input type="file" class="form-control" name="ceo_image" accept="image/*">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Name</label>
                                        <input type="text" class="form-control" name="ceo_name" value="{{ $data->ceo_name }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Designation</label>
                                        <input type="text" class="form-control" name="ceo_designation" value="{{ $data->ceo_designation }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Tag</label>
                                        <input type="text" class="form-control" name="ceo_tag" value="{{ $data->ceo_tag }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Title</label>
                                        <input type="text" class="form-control" name="ceo_title" value="{{ $data->ceo_title }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold">CEO Quote</label>
                                        <textarea class="form-control summernote" name="ceo_quote" rows="3">{!! $data->ceo_quote !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">Timeline Header</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Timeline Tag</label>
                                    <input type="text" class="form-control" name="timeline_tag" value="{{ $data->timeline_tag }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Timeline Title</label>
                                    <input type="text" class="form-control" name="timeline_title" value="{{ $data->timeline_title }}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
                                <span id="btnText">Update About Page</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
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

            // Form Submit Loader
            $('#aboutForm').on('submit', function() {
                $("#fullPageLoader").css("display", "flex");
                $("#submitBtn").prop("disabled", true);
                $("#btnSpinner").removeClass("d-none");
                $("#btnText").text(' Updating...');
            });
        });
    </script>
@endsection