@extends('layouts.app')

@section('title', 'Show '.$pageTitle)

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/roles" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Show {{ $pageTitle }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="m-0">Show {{ $pageTitle }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                            </div>
                            <div class="float-right">
                            </div>
                            <table class="table table-hover w-100">
                                <tr>
                                    <td width="20%">Name</td>
                                    <td>{{ $role->name }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Role</td>
                                    <td>
                                        @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                                <div class="badge badge-success mr-1 mb-1">{{ $v->name }}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <span id="card_title">
                            <h4 class="m-0">{{ __('Show Role') }}</h4>
                        </span>
                        <div class="float-right">
                            <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm float-right font-weight-bolder">
                                <i class="fa fa-arrow-left"></i>Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover w-100">
                            <tr>
                                <td width="20%">Name</td>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    @if(!empty($rolePermissions))
                                        <ol>
                                            @foreach($rolePermissions as $v)
                                                <li>{{ $v->name }}</li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </td>
                            </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush