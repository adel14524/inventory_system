@extends('admin.admin_master')

@section('main')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><b>MANAGE USER ROLE</b></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('role.all') }}">User Role Management</a></li>
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
                            <h4 class="card-title"><b>Add User Role</b></h4><br><br>

                            <form method="post" action="{{ route('role.store') }}" id="myForm">
                                @csrf

                                <div class="row mb-4">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Role</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" type="text"  value="{{ old('name') }}"  >

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <hr>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-12 col-form-label">Permission:</label>
                                    <br><br>
                                    <div class="form-group col-sm-6">
                                        @foreach ($permissions as $permission)
                                            <br><input name="permission[]" class="form-check-input mb-3 parent" type="checkbox" value="{{ $permission->id }}" id="formCheck{{ $permission->id }}">&nbsp;{{ $permission->name }}

                                            @if (!$permission->children->isEmpty())
                                                <div class="ml-3" style="margin-left: 10px;">
                                                    @foreach ($permission->children as $child)
                                                        <br><input data-parent="{{ $permission->id }}" name="permission[]" class="form-check-input mb-3 child" type="checkbox" value="{{ $child->id }}" id="formCheck{{ $child->id }}">&nbsp;{{ $child->name }}
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- end row -->

                                <br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add User Roles">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
