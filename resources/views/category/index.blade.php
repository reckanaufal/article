@extends('layouts.app')

@section('title', 'Posts')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
{{-- datatable --}}
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        {{-- <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-button">
                @can('category-create')
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add New</a>
                @endcan
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">{{ $pageTitle }}</a></div>
                <div class="breadcrumb-item">All {{ $pageTitle }}</div>
            </div>
        </div> --}}
        <div class="section-body">
            {{-- <h2 class="section-title">{{ $pageTitle }}</h2>
            <p class="section-lead">
                You can manage all {{ $pageTitle }}s, such as editing, deleting and more.
            </p> --}}
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
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="justify-content: space-between">
                            <h4>All {{ $pageTitle }}</h4>
                            @can('category-create')
                                <a href="{{ route('category.create') }}" class="btn btn-primary" style="border-radius: 5px">Add New</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                            </div>
                            <div class="float-right">
                            </div>
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <div id="table-wrapper">
                                    <div id="table-scroll"> 
                                            @can('category-list')
                                                <table class="table-striped table" id="table-roles">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Name</th>
                                                            <th>Created At</th>
                                                            <th class="text-center" width="1%">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($category as $item)
                                                            <tr>
                                                                <td class="text-center">
                                                                    {{ $loop->iteration }}.
                                                                </td>
                                                                <td>{{ $item->name }}
                                                                    {{-- <div class="table-links">
                                                                        <a href="{{ route('category.show', $item->id) }}">View</a>
                                                                        <div class="bullet"></div>
                                                                        <a href="{{ route('category.edit', $item->id) }}">Edit</a>
                                                                        <div class="bullet"></div>
                                                                        <a href="{{ route('category.destroy', $item->id) }}" class="text-danger">Trash</a>
                                                                    </div> --}}
                                                                </td>
                                                                <td>{{ $item->created_at }}</td>
                                                                <td>
                                                                    <form id="myForm-{{ $item->id }}" action="{{ route('category.destroy', $item->id ?? '') }}" method="POST" class="d-flex">
                                                                        @can('category-show')
                                                                            <a class="btn btn-primary mr-1" href="{{ route('category.show',$item->id) }}" data-toggle="tooltip" title="Show">
                                                                                <i class="fa fa-fw fa-eye p-0"></i>
                                                                            </a>
                                                                        @endcan
                                                                        @can('category-edit')
                                                                            <a class="btn btn-success btn-action mr-1" href="{{ route('category.edit',$item->id) }}" data-toggle="tooltip" title="Edit">
                                                                                <i class="fa fa-pencil-alt p-0"></i>
                                                                            </a>
                                                                        @endcan
                                                                        @can('category-delete')
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger btn-action" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="confirmDelete({{ $item->id }})">
                                                                                <i class="fa fa-trash-alt p-0"></i>
                                                                            </button>
                                                                        @endcan
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            {{-- <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // trigger submit for delete data
    function confirmDelete($id) {
        var id = $id;
        $('#myForm-' + id).submit();
    }
</script>
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>

{{-- datatable --}}
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
