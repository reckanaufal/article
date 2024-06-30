@extends('layouts.app')

@section('title', 'Users Data')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

    {{-- datatable --}}
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">

    <!-- Modal -->
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="m-0">{{ $message }}</p>
        </div>
    @endif
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $pageTitle }}</h1>
                <div class="section-header-button">
                    @can('user-create')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
                    @endcan
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
                    You can manage all posts, such as editing, deleting and more.
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
                                    @can('user-pdf')
                                        <div class="input-group">
                                            <a href="{{ url('/exportPdfUsers') }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                                <i class="fas fa-file-pdf fa-sm text-white-75">&nbsp;Export PDF</i>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                                <div class="float-right">
                                    @can('user-excel')
                                        <div class="input-group">
                                            <a href="{{ url('/exportExcelUsers') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                                <i class="fas fa-file-excel fa-sm text-white-75">&nbsp;Export Excel</i>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <div id="table-wrapper">
                                        <div id="table-scroll">                        
                                            {{-- <table class="table-striped table" id="table-users">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Created At</th>
                                                        <th class="text-center" width="1%">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $item)
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $loop->iteration }}.
                                                            </td>
                                                            <td>{{ $item->name }}
                                                                <div class="table-links">
                                                                    <a href="{{ route('users.show', $item->id) }}">View</a>
                                                                    <div class="bullet"></div>
                                                                    <a href="{{ route('users.edit', $item->id) }}">Edit</a>
                                                                    <div class="bullet"></div>
                                                                    <a href="{{ route('users.destroy', $item->id) }}" class="text-danger">Trash</a>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->username }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td>
                                                                <form id="myForm-{{ $item->id }}" action="{{ route('users.destroy',$item->id) }}" method="POST" class="d-flex">
                                                                    @can('user-show')
                                                                        <a id="modal-user-show" data-user="{{ $item->name.'-'.$item->username.'-'.$item->email }}" class="btn btn-primary mr-1" href="{{ route('users.show',$item->id) }}" title="Show">
                                                                            <i class="fa fa-fw fa-eye p-0"></i>
                                                                        </a>
                                                                    @endcan
                                                                    @can('user-edit')
                                                                        <a class="btn btn-success btn-action mr-1" href="{{ route('users.edit',$item->id) }}" data-toggle="tooltip" title="Edit">
                                                                            <i class="fa fa-pencil-alt p-0"></i>
                                                                        </a>
                                                                    @endcan
                                                                    @can('user-delete')
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
                                            </table> --}}
                                            @can('user-list')
                                                <table class="table-striped table" id="table-users"></table>
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
        $(document).ready(function() {
            $("#table-users").dataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {
                        title: 'No.',
                        data: null,
                        class: 'text-center',
                        width: '0.1%',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        width: '1%',
                        render: function(data, type, row) {
                            return row.name;
                        }
                    },
                    {
                        title: 'Username',
                        data: 'username',
                        width: '1%',
                        render: function(data, type, row) {
                            return row.username;
                        }
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        width: '1%',
                        render: function(data, type, row) {
                            return row.email;
                        }
                    },
                    {
                        title: 'Roles',
                        data: 'role_names',
                        width: '1%',
                        render: function(data, type, row) {
                            return row.role_names.join(', ');
                        }
                    },
                    {
                        title: 'Action',
                        class: 'text-center',
                        width: '0.1%',
                        data: 'id',
                        render: function(id, type, row) {
                            return `
                                <form id="myForm-${id}" action="{{ url('users') }}/${id}" method="POST" class="d-flex">
                                    @can('user-show')
                                        <a id="modal-user-show" data-user="${row.name}-${row.username}-${row.email}" class="btn btn-primary mr-1" href="{{ url('users') }}/${id}" title="Show">
                                            <i class="fa fa-fw fa-eye p-0"></i>
                                        </a>
                                    @endcan
                                    @can('user-edit')
                                        <a class="btn btn-success btn-action mr-1" href="{{ url('users') }}/${id}/edit" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-pencil-alt p-0"></i>
                                        </a>
                                    @endcan
                                    @can('user-delete')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="confirmDelete(${id})">
                                            <i class="fa fa-trash-alt p-0"></i>
                                        </button>
                                    @endcan
                                </form>
                            `;
                        }
                    }
                ],
                order: [[1, "ASC"]],
                columnDefs: [
                    { "sortable": false, "targets": [5] }
                ]
            });


            // var table = $('#table-users').dataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: "{{ route('users.index') }}",
            //         columns: [
            //             {
            //                 title: 'No',
            //                 class: 'text-center',
            //                 width: '1%',
            //                 data: 'id'
            //             },
            //             {
            //                 title: 'Name',
            //                 data: 'users',
            //                 width: '1%',
            //                 render: function(r, x, i) {
            //                     return String(i.name);
            //                 }
            //             },
            //             {
            //                 title: 'Username',
            //                 data: 'usename',
            //                 width: '1%',
            //                 render: function(r, x, i) {
            //                     return String(i.username);
            //                 }
            //             },
            //             {
            //                 title: 'Email',
            //                 data: 'email',
            //                 width: '1%',
            //                 render: function(r, x, i) {
            //                     return String(i.email);
            //                 }
            //             },
            //             {
            //                 title: 'Action',
            //                 class: 'text-center',
            //                 width: '1%',
            //                 data: 'id',
            //                 render: function(id, x, i) {
            //                     return `
            //                         <form action="{{ route('users.index') }}/${id}" method="POST" class="d-flex">
            //                             @can('memo-item-in-show')
            //                                 <a class="btn btn-primary btn-xs d-flex justify-content-center align-items-center" href="{{ route('memo-item-ins.index') }}/${id}"><i class="fa fa-fw fa-eye p-0"></i></a>
            //                             @endcan
            //                             @can('memo-item-in-edit')
            //                                 <a class="btn btn-success btn-xs d-flex justify-content-center align-items-center" href="{{ route('memo-item-ins.index') }}/${id}/edit"><i class="fa fa-pencil-alt p-0"></i></a>
            //                             @endcan
            //                             @can('memo-item-in-delete')
            //                                 @csrf
            //                                 @method('DELETE')
            //                                 <button type="submit" class="btn btn-danger btn-xs d-flex justify-content-center align-items-center btn-delete"><i class="fa fa-trash-alt p-0"></i></button>
            //                             @endcan
            //                         </form>
            //                     `;
            //                 }
            //             },
            //         ],
            //         order: [[ 0, "DESC" ]],
            //         "columnDefs": [
            //             { "sortable": false, "targets": [0,2,3] }
            //         ]
            // })
            //     console.log(table.order);
                // table.on( 'draw.dt', function () {
                //     var info = table.page.info();
                //     var i = 0;
                //     for (let x = (info.start + 1); x <= info.end; x++) {
                //         table.column(0).nodes()[i].innerHTML = x;
                //         i++;
                //     }
                // } ).draw();
        });
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

    {{-- Modal --}}
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <script>
        // $("#modal-user-show").click(function() {
        //     var myData = $('#modal-user-show').data('user');
        //     var myArray = myData.split("-");
        //     console.log(myArray);
        //     $("#modal-user-show").fireModal({
        //         body: myArray
                    
        //     });
        // });
    </script>
@endpush
