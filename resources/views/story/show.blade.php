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
                <a href="/story" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
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
                                    <td width="20%">Title Article</td>
                                    <td>{{ $story->title }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Content</td>
                                    <td>{{ $story->content }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Category</td>
                                    <td>{{ $story->category->name }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Photo</td>
                                    <td>
                                        @if($story->image)
                                            <img src="{{ asset('images/' . $story->image) }}" alt="Story Photo" style="max-width: 20rem; height: auto;">
                                        @else
                                            No photo available.
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
@endsection
@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush