<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Stockly</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="{{ asset('admin/assets/images/logo-dark.png') }}" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="{{ asset('admin/assets/images/logo-light.png') }}" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>

                        <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

                        <div class="p-3">
                            <form class="form-horizontal mt-3" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="username" class="form-control @error('username') is-invalid @enderror" name="username" type="text" value="{{ old('username') }}" required="" placeholder="Username" autofocus >

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <input id="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" required="" placeholder="First Name" autofocus>

                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <input id="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" required="" placeholder="Last Name" autofocus>

                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required="" placeholder="Email" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone') }}" required="" placeholder="Phone No" autofocus>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="Password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-3 text-center">
                                        <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->


        <!-- JAVASCRIPT -->
        <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('admin/assets/js/app.js') }}"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type','info') }}"
                switch(type){
                    case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                    case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                    case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                    case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
                }
            @endif
        </script>
    </body>
</html>
