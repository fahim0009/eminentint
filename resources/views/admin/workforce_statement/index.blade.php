@extends('admin.pages.master')
@section('title', 'Workforce Statement')
@section('content')

    <!-- Full Page Loader Overlay -->
    <div id="fullPageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10">

                @if (session()->has('success'))
                    <div class="alert alert-success pt-3 mb-3">{{ session()->get('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Trusted Workforce Statement (Navy Banner)</h3>
                    </div>

                    <form action="{{ route('workforce.update') }}" method="POST" id="workforceForm">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3">
                                
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Main Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="{{ $data->title }}" placeholder="e.g. Trusted Workforce Partner for Saudi Arabia & Global Employers">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="From sourcing and screening to deployment...">{{ $data->description }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Button 1 Text (Modal Trigger)</label>
                                    <input type="text" class="form-control" name="btn1_text" value="{{ $data->btn1_text }}" placeholder="e.g. Submit Worker Requirement">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Button 2 Text (Contact Link)</label>
                                    <input type="text" class="form-control" name="btn2_text" value="{{ $data->btn2_text }}" placeholder="e.g. Contact Our Offices">
                                </div>

                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
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
            // Form Submit Loader
            $('#workforceForm').on('submit', function() {
                $("#fullPageLoader").css("display", "flex");
                $("#submitBtn").prop("disabled", true);
                $("#btnSpinner").removeClass("d-none");
                $("#btnText").text(' Updating...');
            });
        });
    </script>
@endsection