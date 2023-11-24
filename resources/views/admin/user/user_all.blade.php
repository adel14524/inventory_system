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
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Setting</li>
                                <li class="breadcrumb-item active">User Management</li>
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
                            @can('create_user')
                                <a href="{{ route('user.add') }}" class="btn btn-dark waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle">&nbsp;&nbsp;Add User</i></a>
                            @endcan
                            <br><br>
                            <h4 class="card-title"><b>All User</b></h4>
                            <br>
                            <table id="UserTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="6%">Sl</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <script type="text/javascript">
        var userPermissions = {
            canEditUser: @can('edit_user') true @else false @endcan,
            canDeleteUser: @can('delete_user') true @else false @endcan,
        };
    </script>

@endsection
