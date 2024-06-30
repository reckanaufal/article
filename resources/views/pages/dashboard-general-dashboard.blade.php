@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush
<style>
    .story-card {
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }

    .story-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
@section('main')
    <div class="main-content">
        <section class="section">
            {{-- <div class="section-header">
                <h1>{{ $pageTitle}}</h1>
            </div> --}}
            <div class="row mb-4">
                <div class="col-lg-5 col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-2 col-md-12">
                    <select class="form-control form-control-sm">
                        <option value="">Category</option>
                        <!-- Add your categories here -->
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12">
                    <a href="{{ route('story.create') }}" class="btn btn-primary btn-block btn-lg" style="border-color: transparent; background: linear-gradient(to right, #2e2e2e, #1d75d3);">
                        <div>
                            Create Article
                            <i class="fa-solid fa-pencil" style="margin: 0 5px 0 5px;"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-12 col-12 col-sm-12"></div>
            </div>
            
            <div class="row">
                <div class="col-lg-9 col-md-12 col-12 col-sm-12 story-list">
                    <div class="row">
                        @foreach ($story as $item)
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card mb-4 story-card" style="border-radius: 10px;" data-id="{{ $item->id }}">
                                    <img src="{{ asset('images/'. $item->image) }}" style="width: auto; height: 10rem; border-radius:10px;" class="card-img-top m-3" alt="Nama Gambar">
                                    <div class="card-body">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <h5 class="card-title">{{ $item->title}}</h5>
                                            <span class="card-date">30 June 2024</span>
                                        </div>
                                        <p class="card-text" style="line-height: 1.5">{{ Str::limit($item->content, 100, '...') }}</p>
                                        <a href="#" class="btn btn-primary" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Technologies</a>
                                        <a href="#" class="btn btn-primary" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Work</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="story-detail" class="col-lg-9 col-md-12 col-12 col-sm-12 mt-4" style="display: none;">
                    <a href="/dashboard-general-dashboard" class="btn btn-primary mb-3" style="color: white; text-decoration: none;">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </a>                    
                    <div class="card p-5" style="border-radius: 10px;">
                        <img id="story-detail-image" style="width: 100%; border-radius:10px;" class="card-img-top" alt="Gambar">
                        <div class="card-body p-0 mt-3">
                            <h5 id="story-detail-title" class="card-title"></h5>
                            <p id="story-detail-content" class="card-text"></p>
                            <a href="#" class="btn btn-primary" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Technologies</a>
                            <a href="#" class="btn btn-primary" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Work</a>
                        </div>
                    </div>
                </div>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('.story-card').forEach(function(card) {
                            card.addEventListener('click', function() {
                                var storyId = this.getAttribute('data-id');
                                fetch(`/detail/${storyId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        document.getElementById('story-detail-image').src = `/images/${data.image}`;
                                        document.getElementById('story-detail-title').innerText = data.title;
                                        document.getElementById('story-detail-content').innerText = data.content;
                                        document.querySelector('.story-list').style.display = 'none';
                                        document.getElementById('story-detail').style.display = 'block';
                                    })
                                .catch(error => console.error('Error:', error));
                            });
                        });
                    });
                </script>
            

                <div class="col-lg-3 col-md-12 col-12 col-sm-12">
                    <div class="card" style="position: -webkit-sticky; position: sticky; top: 20px; border-radius: 10px; overflow: hidden;">
                        <div class="card-header py-0" style="min-height: 50px;">
                            <h4 class="font-weight-bold" style="color: black">Your Article</h4>
                        </div>
                        <div class="card-body p-1"  style="max-height: 400px; overflow-y: auto;">
                            @foreach ($story as $item)
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="col-lg-5 col-md-4 col-4 col-sm-4 p-0">
                                            <img src="{{ asset('images/'.$item->image) }}" class="img-fluid" style="border-radius: 10px;" alt="Nama Gambar">
                                        </div>
                                        <div class="col-lg-7 col-md-8 col-8 col-sm-8">
                                            <div class="media-body">
                                                <div class="media-title font-weight-bold" style="color: black">{{ $item->title}}</div>
                                                <span class="text-small" style="color: black">{{ Str::limit($item->content, 25, '...') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer py-2">
                            <div class="mb-2">
                                <span class="font-weight-bold" style="color: black;">All Category</span>
                            </div>
                            <div class="mb-2">
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Technologies</a>
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Design</a>
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">IT</a>
                            </div>
                            <div>
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">work</a>
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Web</a>
                                <a href="#" class="btn" style="box-shadow: none; background-color: #e7e7e7; color: black; border-color: transparent">Programmer</a>
                            </div>
                        </div>
                    </div>                                      
                </div>    
            </div>
            {{-- <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body pt-2 pb-2">
                            <div id="myWeather">Please wait</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Authors</h4>
                        </div>
                        <div class="card-body">
                            <div class="row pb-2">
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image"
                                            src="{{ asset('img/avatar/avatar-5.png') }}"
                                            class="img-fluid"
                                            data-toggle="tooltip"
                                            title="Alfa Zulkarnain">
                                        <div class="avatar-badge"
                                            title="Editor"
                                            data-toggle="tooltip"><i class="fas fa-wrench"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image"
                                            src="{{ asset('img/avatar/avatar-4.png') }}"
                                            class="img-fluid"
                                            data-toggle="tooltip"
                                            title="Egi Ferdian">
                                        <div class="avatar-badge"
                                            title="Admin"
                                            data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image"
                                            src="{{ asset('img/avatar/avatar-1.png') }}"
                                            class="img-fluid"
                                            data-toggle="tooltip"
                                            title="Jaka Ramadhan">
                                        <div class="avatar-badge"
                                            title="Author"
                                            data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-3 col-lg-3 mb-md-0 mb-4">
                                    <div class="avatar-item mb-0">
                                        <img alt="image"
                                            src="{{ asset('img/avatar/avatar-2.png') }}"
                                            class="img-fluid"
                                            data-toggle="tooltip"
                                            title="Ryan">
                                        <div class="avatar-badge"
                                            title="Admin"
                                            data-toggle="tooltip"><i class="fas fa-cog"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Referral URL</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">2,100</div>
                                <div class="font-weight-bold mb-1">Google</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="80%"
                                        aria-valuenow="80"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">1,880</div>
                                <div class="font-weight-bold mb-1">Facebook</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="67%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">1,521</div>
                                <div class="font-weight-bold mb-1">Bing</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="58%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">884</div>
                                <div class="font-weight-bold mb-1">Yahoo</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="36%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">473</div>
                                <div class="font-weight-bold mb-1">Kodinger</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="28%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="text-small font-weight-bold text-muted float-right">418</div>
                                <div class="font-weight-bold mb-1">Multinity</div>
                                <div class="progress"
                                    data-height="3">
                                    <div class="progress-bar"
                                        role="progressbar"
                                        data-width="20%"
                                        aria-valuenow="25"
                                        aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Popular Browser</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="browser browser-chrome"></div>
                                    <div class="font-weight-bold mt-2">Chrome</div>
                                    <div class="text-muted text-small"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 48%</div>
                                </div>
                                <div class="col text-center">
                                    <div class="browser browser-firefox"></div>
                                    <div class="font-weight-bold mt-2">Firefox</div>
                                    <div class="text-muted text-small"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 26%</div>
                                </div>
                                <div class="col text-center">
                                    <div class="browser browser-safari"></div>
                                    <div class="font-weight-bold mt-2">Safari</div>
                                    <div class="text-muted text-small"><span class="text-danger"><i
                                                class="fas fa-caret-down"></i></span> 14%</div>
                                </div>
                                <div class="col text-center">
                                    <div class="browser browser-opera"></div>
                                    <div class="font-weight-bold mt-2">Opera</div>
                                    <div class="text-muted text-small">7%</div>
                                </div>
                                <div class="col text-center">
                                    <div class="browser browser-internet-explorer"></div>
                                    <div class="font-weight-bold mt-2">IE</div>
                                    <div class="text-muted text-small"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 5%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-sm-5 mt-md-0">
                        <div class="card-header">
                            <h4>Visitors</h4>
                        </div>
                        <div class="card-body">
                            <div id="visitorMap"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>This Week Stats</h4>
                            <div class="card-header-action">
                                <div class="dropdown">
                                    <a href="#"
                                        class="dropdown-toggle btn btn-primary"
                                        data-toggle="dropdown">Filter</a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#"
                                            class="dropdown-item has-icon"><i class="far fa-circle"></i> Electronic</a>
                                        <a href="#"
                                            class="dropdown-item has-icon"><i class="far fa-circle"></i> T-shirt</a>
                                        <a href="#"
                                            class="dropdown-item has-icon"><i class="far fa-circle"></i> Hat</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#"
                                            class="dropdown-item">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="summary">
                                <div class="summary-info">
                                    <h4>$1,053</h4>
                                    <div class="text-muted">Sold 3 items on 2 customers</div>
                                    <div class="d-block mt-2">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                                <div class="summary-item">
                                    <h6>Item List <span class="text-muted">(3 Items)</span></h6>
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <a href="#">
                                                <img class="mr-3 rounded"
                                                    width="50"
                                                    src="{{ asset('img/products/product-1-50.png') }}"
                                                    alt="product">
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right">$405</div>
                                                <div class="media-title"><a href="#">PlayStation 9</a></div>
                                                <div class="text-muted text-small">by <a href="#">Hasan Basri</a>
                                                    <div class="bullet"></div> Sunday
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <a href="#">
                                                <img class="mr-3 rounded"
                                                    width="50"
                                                    src="{{ asset('img/products/product-2-50.png') }}"
                                                    alt="product">
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right">$499</div>
                                                <div class="media-title"><a href="#">RocketZ</a></div>
                                                <div class="text-muted text-small">by <a href="#">Hasan Basri</a>
                                                    <div class="bullet"></div> Sunday
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <a href="#">
                                                <img class="mr-3 rounded"
                                                    width="50"
                                                    src="{{ asset('img/products/product-3-50.png') }}"
                                                    alt="product">
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right">$149</div>
                                                <div class="media-title"><a href="#">Xiaomay Readme 4.0</a></div>
                                                <div class="text-muted text-small">by <a href="#">Kusnaedi</a>
                                                    <div class="bullet"></div> Tuesday
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="d-inline">Tasks</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-1">
                                        <label class="custom-control-label"
                                            for="cbx-1"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('img/avatar/avatar-4.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Redesign header</a></h6>
                                        <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div>
                                            <span class="text-primary">Now</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-2"
                                            checked="">
                                        <label class="custom-control-label"
                                            for="cbx-2"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('img/avatar/avatar-5.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-primary float-right mb-1">Completed</div>
                                        <h6 class="media-title"><a href="#">Add a new component</a></h6>
                                        <div class="text-small text-muted">Serj Tankian <div class="bullet"></div> 4 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-3">
                                        <label class="custom-control-label"
                                            for="cbx-3"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('img/avatar/avatar-2.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-warning float-right mb-1">Progress</div>
                                        <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                                        <div class="text-small text-muted">Ujang Maman <div class="bullet"></div> 8 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="cbx-4">
                                        <label class="custom-control-label"
                                            for="cbx-4"></label>
                                    </div>
                                    <img class="rounded-circle mr-3"
                                        width="50"
                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Remove unwanted classes</a></h6>
                                        <div class="text-small text-muted">Farhan A Mujib <div class="bullet"></div> 21
                                            Min</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                    <form method="post"
                        class="needs-validation"
                        novalidate="">
                        <div class="card">
                            <div class="card-header">
                                <h4>Quick Draft</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text"
                                        name="title"
                                        class="form-control"
                                        required>
                                    <div class="invalid-feedback">
                                        Please fill in the title
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="summernote-simple"></textarea>
                                </div>
                            </div>
                            <div class="card-footer pt-0">
                                <button class="btn btn-primary">Save Draft</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Posts</h4>
                            <div class="card-header-action">
                                <a href="#"
                                    class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped mb-0 table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Introduction Laravel 5
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Laravel 5 Tutorial - Installation
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Laravel 5 Tutorial - MVC
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Laravel 5 Tutorial - Migration
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Laravel 5 Tutorial - Deploy
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Laravel 5 Tutorial - Closing
                                                <div class="table-links">
                                                    in <a href="#">Web Development</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="font-weight-600"><img
                                                        src="{{ asset('img/avatar/avatar-1.png') }}"
                                                        alt="avatar"
                                                        width="30"
                                                        class="rounded-circle mr-1"> Bagus Dwi Cahya</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1"
                                                    data-toggle="tooltip"
                                                    title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action"
                                                    data-toggle="tooltip"
                                                    title="Delete"
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
