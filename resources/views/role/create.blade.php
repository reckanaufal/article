@extends('layouts.app')

@section('title', 'Create New Role')

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
                    <a href="features-posts.html"
                        class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New {{ $pageTitle ?? '' }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">{{ $pageTitle ?? '' }}s</a></div>
                    <div class="breadcrumb-item">Create New {{ $pageTitle ?? '' }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create New {{ $pageTitle ?? '' }}</h2>
                <p class="section-lead">
                    On this page you can create a new {{ $pageTitle ?? '' }} and fill in all fields.
                </p>
                <form method="POST" action="{{ route('roles.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Write Your {{ $pageTitle ?? '' }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="name" placeholder="Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label>Permission</label>
                                        <table class="table table-bordered">
                                            <tr class="bg-success">
                                                <td width="1%">
                                                    <input id="head" type="checkbox">
                                                </td>
                                                <td>
                                                    <label for="head" class="m-0 text-white">Check All</label>
                                                </td>
                                            </tr>
                                            @php $lastp = ""; @endphp
                                            @foreach($permissions as $value)
                                                @php $v = explode('-', $value->name)[0]; @endphp
                                                @if($lastp != $v)
                                                    <tr class="bg-primary">
                                                        <td>
                                                            <input class="head-2" data-child=".{{ $v }}" type="checkbox" id="{{ $v }}-head">
                                                        <td>
                                                            <label for="{{ $v }}-head" class="m-0 text-white">{{ ucfirst($v) }}</label>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td width="1%">
                                                        <input type="checkbox" name="permission[]" class="name all {{ $v }}" id="{{ $value->name }}" value="{{ $value->id }}">
                                                    </td>
                                                    <td>
                                                        <label for="{{ $value->name }}" class="m-0">{{ $value->name }}</label>
                                                    </td>
                                                </tr>
                                                @php $lastp = $v; @endphp
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
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
    <script>
        $('#head').click(function() {
            $(".all").prop('checked', this.checked);
            $(".head-2").prop('checked', this.checked);
        });
        $('.head-2').click(function() {
            var v = $(this).data('child');
            $(v).prop('checked', this.checked);
        });
    </script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
@endpush