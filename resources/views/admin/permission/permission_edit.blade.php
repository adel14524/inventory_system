@extends('admin.admin_master')

@section('main')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">MANAGE PERMISSION</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('permission.all') }}">Permission Management</a></li>
                                <li class="breadcrumb-item active">Edit</li>
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
                            <h4 class="card-title"><b>Edit Permission</b></h4><br><br>

                            <form method="post" action="{{ route('permission.update') }}" id="myForm" >
                                @csrf

                                <input type="hidden" name="id" value="{{ $permission->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Permission</label>
                                    <div class="form-group col-sm-10">
                                        <input id="name" name="name" class="form-control" value="{{ $permission->name }}" type="text"    >
                                    </div>
                                </div>
                                <!-- end row -->

                                <br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Permission">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    }
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
                    }
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

@endsection
