<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Kishack</title>

    <link rel="icon" href="{{ asset('img/logo/rapp-mini-logo.png') }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    {{-- Template Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        body  {
          background-image: url("images/ground.jpg");
          background-color: #cccccc;
          background-repeat: no-repeat;
          background-size: cover;
        }
        </style>
</head>

<body>
    <div id="app">
        <section class="">
            <div class="container-fluid">
                <div class="row d-flex w-100 h-100" style="justify-content: center;">
                    <div class="col-lg-4 col-md-6 col-12 my-5 bg-white" style="border-radius: 10px">
                        <div class="m-3 px-4 py-2">
                            <div class="text-center mb-2">
                                <img src="{{ asset('images/kis2.png') }}" alt="logo" style="width: 6rem;">
                            </div>                        
                            <div class="text-center mb-4">
                                <h5 class="font-weight-normal">
                                    <span class="font-weight-bold">Sign In</span>
                                </h5>
                                Enter your email and password to log in
                            </div>
                            <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
                                @csrf
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">
                                                <span>&times;</span>
                                            </button>
                                            <strong>Error!</strong> {{ $errors->first() }}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Please fill in your Username
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <input id="password" type="password" class="form-control form-password" name="password" tabindex="2">
                                            <div class="input-group-prepend" style="cursor: pointer;">
                                                <div class="input-group-text icon-eye">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye PassIcon" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash hiddenPassIcon" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <a href="/auth-forgot-password" style="color: rgb(0, 70, 191); font-weight: bold">
                                        Forgot Password?
                                    </a>
                                </div>
                                <div class="mt-5 text-center">
                                    <button type="submit" class="btn btn-primary" tabindex="4" style="width: 8.5rem; height:2.5rem ; border: transparent; border-color: transparent; background: linear-gradient(to left, #3c3c3c, #258eff);">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Show and hidden password --}}
    <script>
        $(document).ready(function(){	
            var showPass = false;	
            $(".hiddenPassIcon").css("display", "block");
            $(".PassIcon").css("display", "none");
            
            $('.icon-eye').click(function(){
                console.log(showPass);
                if(showPass == false){
                    showPass = true;
                    $('.form-password').attr('type','text');
                    $(".hiddenPassIcon").css("display", "none");
                    $(".PassIcon").css("display", "block");
                }else{
                    showPass = false;
                    $('.form-password').attr('type','password');
                    $(".hiddenPassIcon").css("display", "block");
                    $(".PassIcon").css("display", "none");
                }
            });
        });
    </script>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
