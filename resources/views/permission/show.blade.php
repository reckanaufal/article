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
                <a href="/permissions" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
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
                            <table class="table table-hover w-100">
                                <tr>
                                    <td width="20%">Name</td>
                                    <td>{{ $permissions->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush