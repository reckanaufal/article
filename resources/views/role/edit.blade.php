@extends('layouts.app')

@section('title', 'Edit Post')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @includeif('partials.errors')
                <div class="section-header-back">
                    <a href="/roles" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
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
                    On this page you can create a edit role and fill in all fields.
                </p>
                <form method="POST" action="{{ route('roles.update', $role->id) }}"  role="form" enctype="multipart/form-data">
                    @method('PUT') 
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
                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}" required>
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
                                                        <input type="checkbox" name="permission[]" class="name all {{ $v }}" id="{{ $value->name }}" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                        {{-- {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name all '.$v, 'id' => $value->name]) }} --}}
                                                    </td>
                                                    <td>
                                                        <label for="{{ $value->name }}" class="m-0">{{ ucfirst(ltrim(strstr($value->name, '-'), '-')) }}</label>
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

        // onclick checkbox checked and then unchecked select all
        // Please reselect the data that was previously checked.
        $(document).ready(function(){
            var checkedPermission = [];
            $('input[type="checkbox"][name="permission[]"]:checked').each(function() {
                checkedPermission.push($(this).attr('id'));
            });

            $('input[type="checkbox"][id="head"]').click(function() {
                if (!$(this).prop('checked')) {
                    $(checkedPermission).each(function(index, element){
                        $('#' + element).prop('checked', true);
                    })
                }
            });
            $('input[type="checkbox"][class="head-2"]').click(function() {
                if (!$(this).prop('checked')) {
                    $(checkedPermission).each(function(index, element){
                        $('#' + element).prop('checked', true);
                    })
                }
            });
        });


    </script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush