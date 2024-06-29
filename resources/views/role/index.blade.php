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
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-button">
                <a href="{{ route('roles.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">{{ $pageTitle }}</a></div>
                <div class="breadcrumb-item">All {{ $pageTitle }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ $pageTitle }}</h2>
            <p class="section-lead">
                You can manage all {{ $pageTitle }}s, such as editing, deleting and more.
            </p>
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
                        <div class="card-header">
                            <h4>All {{ $pageTitle }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                {{-- <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Move to Draft</option>
                                    <option>Move to Pending</option>
                                    <option>Delete Pemanently</option>
                                </select> --}}
                            </div>
                            <div class="float-right">
                                {{-- <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <div id="table-wrapper">
                                    <div id="table-scroll"> 
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
                                                @foreach ($roles as $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ $loop->iteration }}.
                                                        </td>
                                                        <td>{{ $item->name }}
                                                            <div class="table-links">
                                                                <a href="{{ route('roles.show', $item->id) }}">View</a>
                                                                <div class="bullet"></div>
                                                                <a href="{{ route('roles.edit', $item->id) }}">Edit</a>
                                                                <div class="bullet"></div>
                                                                <a href="{{ route('roles.destroy', $item->id) }}" class="text-danger">Trash</a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>
                                                            <form id="myForm-{{ $item->id }}" action="{{ route('roles.destroy', $item->id ?? '') }}" method="POST" class="d-flex">
                                                                @can('role-show')
                                                                    <a class="btn btn-primary mr-1" href="{{ route('roles.show',$item->id) }}" data-toggle="tooltip" title="Show">
                                                                        <i class="fa fa-fw fa-eye p-0"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('role-edit')
                                                                    <a class="btn btn-success btn-action mr-1" href="{{ route('roles.edit',$item->id) }}" data-toggle="tooltip" title="Edit">
                                                                        <i class="fa fa-pencil-alt p-0"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('role-delete')
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
