@extends('admin.admin_master')

@section('main')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><b>Manage User</b></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('user.all') }}">User Management</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><b>Add User</b></h4>
                            <hr><br>
                            <form method="post" action="{{ route('user.store') }}">
                                @csrf

                                <h3 class="card-title">User Details</h3><br>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="example-text-input" class="form-label mb-2">First Name</label>
                                        <div class="form-group">
                                            <input name="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" value="{{ old('first_name') }}" placeholder="First Name">

                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="example-text-input" class="form-label mb-2">Last Name</label>
                                        <div class="form-group">
                                            <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" value="{{ old('last_name') }}" placeholder="Last Name">

                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="example-text-input" class="form-label">Username</label>
                                    <div class="form-group col-sm-12">
                                        <input name="username" class="form-control @error('username') is-invalid @enderror" type="text" value="{{ old('username') }}" placeholder="Username">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="example-text-input" class="form-label">Email</label>
                                        <div class="form-group">
                                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="example-text-input" class="form-label text-center">Phone No</label>
                                        <div class="form-group">
                                            <input name="phone" class="form-control @error('phone') is-invalid @enderror" type="text" value="{{ old('phone') }}" placeholder="Phone No">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->
                                <hr><br>

                                <h3 class="card-title">Authentication and User Role</h3><br>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="form-label">Password</label>
                                        <div class="form-group">
                                            <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" autocomplete="new-password" placeholder="New Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="form-label">Confirm Password</label>
                                        <div class="form-group">
                                            <input name="password_confirmation" class="form-control" type="password" autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="form-label">User Role</label>
                                        <div class="form-group">
                                            <select class="select2 form-control select2-multiple" name="roles[]" id="roles" multiple="multiple">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add User">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

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

        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "Select a Role",
                allowClear: true,
            });
        });
    </script>
@endsection
