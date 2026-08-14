@extends('admin.pages.master')
@section('title', 'Hero Section Management')
@section('content')

    <!-- Loader Overlay -->
    <div id="pageLoader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
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

                <div class="card">
                    <div class="card-header"><h3 class="card-title mb-0">Homepage Hero Section</h3></div>
                    
                    <form action="{{ route('hero.update') }}" method="POST" enctype="multipart/form-data" id="heroForm">
                        @csrf
                        <div class="card-body">
                            <h5 class="text-navy mb-3 border-bottom pb-2">Text & Buttons</h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Hero Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $data->title }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Hero Subtitle</label>
                                    <textarea class="form-control" name="subtitle" rows="2">{{ $data->subtitle }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Badge 1 Icon</label>
                                    <input type="text" class="form-control" name="badge1_icon" value="{{ $data->badge1_icon }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Badge 1 Text</label>
                                    <input type="text" class="form-control" name="badge1_text" value="{{ $data->badge1_text }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Badge 2 Icon</label>
                                    <input type="text" class="form-control" name="badge2_icon" value="{{ $data->badge2_icon }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Badge 2 Text</label>
                                    <input type="text" class="form-control" name="badge2_text" value="{{ $data->badge2_text }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Button 1 Text (Hire Workers)</label>
                                    <input type="text" class="form-control" name="btn1_text" value="{{ $data->btn1_text }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Button 2 Text (Explore Jobs)</label>
                                    <input type="text" class="form-control" name="btn2_text" value="{{ $data->btn2_text }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Button 3 Text (Tracker)</label>
                                    <input type="text" class="form-control" name="btn3_text" value="{{ $data->btn3_text }}">
                                </div>
                            </div>

                            <h5 class="text-navy mb-3 border-bottom pb-2">Collage Images</h5>
                            <div class="row g-3">
                                @foreach (['image1', 'image2', 'image3', 'image4'] as $img)
                                    <div class="col-md-3 text-center">
                                        <label class="form-label fw-bold">Image {{ $loop->iteration }}</label>
                                        <input type="file" class="form-control" name="{{ $img }}" accept="image/*">
                                        @if($data->$img) 
                                            <img src="{{ asset($data->$img) }}" class="img-thumbnail mt-2" style="max-width: 100%; height: 120px; object-fit: cover;"> 
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
                                <span id="btnText">Update Hero Section</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('heroForm');
            const loader = document.getElementById('pageLoader');
            const submitBtn = document.getElementById('submitBtn');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = document.getElementById('btnText');

            if (form) {
                form.addEventListener('submit', function () {
                    // Show full page loader
                    loader.style.display = 'flex';
                    
                    // Disable button and show button spinner
                    submitBtn.disabled = true;
                    btnSpinner.classList.remove('d-none');
                    btnText.textContent = ' Updating...';
                });
            }
        });
    </script>

@endsection