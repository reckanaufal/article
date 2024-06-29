@extends('layouts.auth')

@section('title', $pageTitle)

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close"
                    data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <strong>{{ session('success') }}</strong>
            </div>
        </div>
    @endif
    @if(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close"
                    data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <strong>{{ session('failed') }}</strong>
            </div>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ $pageTitle }}</h4>
        </div>

        <div class="card-body">
            <p class="text-muted">We will send a link to reset your password</p>
            <form method="POST" action="/forgetPassword">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ $pageTitle }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
