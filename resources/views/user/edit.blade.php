@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @includeif('partials.errors')
                <div class="section-header-back">
                    <a href="/users" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create Edit {{ $pageTitle ?? '' }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">{{ $pageTitle ?? '' }}</a></div>
                    <div class="breadcrumb-item">Create Edit {{ $pageTitle ?? '' }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create Edit {{ $pageTitle ?? '' }}</h2>
                <p class="section-lead">
                    On this page you can create a Edit {{ $pageTitle ?? '' }} and fill in all fields.
                </p>
                <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                    @method('PUT') 
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Write Your {{ $pageTitle ?? '' }}</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="name" placeholder="Name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text" name="username" placeholder="Username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="password" name="password" placeholder="Password" class="form-control">
                                                <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Roles</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control select2" name="roles">
                                                    @foreach ($role as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="col-sm-12 col-md-7 offset-md-3">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
@endpush
