@extends('admin.admin_master')

@section('main')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><b>Manage Permission</b></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Setting</li>
                                <li class="breadcrumb-item active">Permission Management</li>
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
                            @can('create_permission')
                                <a href="{{ route('permission.add') }}" class="btn btn-dark waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle">&nbsp;&nbsp;Add Permission</i></a>
                            @endcan

                            <br><br>
                            <h4 class="card-title"><b>All Permission</b></h4>
                            <br><br>
                            <table id="PermissionTable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="6%">Sl</th>
                                        <th>Name</th>
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
            canEditPermission: @can('edit_permission') true @else false @endcan,
            canDeletePermission: @can('delete_permission') true @else false @endcan,
        };
    </script>

@endsection
