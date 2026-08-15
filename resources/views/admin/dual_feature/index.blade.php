@extends('admin.pages.master')
@section('title', 'Dual Feature Section')
@section('content')
    <div id="fullPageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                @if (session()->has('success'))
                    <div class="alert alert-success pt-3 mb-3">{{ session()->get('success') }}</div>
                @endif
                <div class="card">
                    <div class="card-header"><h3 class="card-title mb-0">Employers & Job Seekers Section</h3></div>
                    <form action="{{ route('dualfeature.update') }}" method="POST" enctype="multipart/form-data" id="dualForm">
                        @csrf
                        <div class="card-body">
                            <h5 class="text-navy mb-3 border-bottom pb-2">For Employers</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tagline</label>
                                    <input type="text" class="form-control" name="employer_tag" value="{{ $data->employer_tag }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Title</label>
                                    <input type="text" class="form-control" name="employer_title" value="{{ $data->employer_title }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea class="form-control" name="employer_desc" rows="2">{{ $data->employer_desc }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Checklist (Use Summernote or &lt;ul&gt;&lt;li&gt;)</label>
                                    <textarea class="form-control summernote" name="employer_list" rows="3">{!! $data->employer_list !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Button Text</label>
                                    <input type="text" class="form-control" name="employer_btn_text" value="{{ $data->employer_btn_text }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Image</label>
                                    <input type="file" class="form-control" name="employer_image" accept="image/*">
                                    @if($data->employer_image) <img src="{{ asset($data->employer_image) }}" class="img-thumbnail mt-2" style="max-width:150px"> @endif
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">For Job Seekers</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Tagline</label>
                                    <input type="text" class="form-control" name="jobseeker_tag" value="{{ $data->jobseeker_tag }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Title</label>
                                    <input type="text" class="form-control" name="jobseeker_title" value="{{ $data->jobseeker_title }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea class="form-control" name="jobseeker_desc" rows="2">{{ $data->jobseeker_desc }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Checklist (Use Summernote or &lt;ul&gt;&lt;li&gt;)</label>
                                    <textarea class="form-control summernote" name="jobseeker_list" rows="3">{!! $data->jobseeker_list !!}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Button Text</label>
                                    <input type="text" class="form-control" name="jobseeker_btn_text" value="{{ $data->jobseeker_btn_text }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Image</label>
                                    <input type="file" class="form-control" name="jobseeker_image" accept="image/*">
                                    @if($data->jobseeker_image) <img src="{{ asset($data->jobseeker_image) }}" class="img-thumbnail mt-2" style="max-width:150px"> @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner"></span>
                                <span id="btnText">Update Section</span>
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
            $('.summernote').summernote({ height: 150 });
            $('#dualForm').on('submit', function() {
                $("#fullPageLoader").css("display", "flex");
                $("#submitBtn").prop("disabled", true);
                $("#btnSpinner").removeClass("d-none");
                $("#btnText").text(' Updating...');
            });
        });
    </script>
@endsection