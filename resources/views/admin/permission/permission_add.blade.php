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
                            <h4 class="card-title"><b>Add Permission</b></h4><br><br>

                            <form method="post" action="{{ route('permission.store') }}">
                                @csrf

                                <div class="row mb-5">
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="form-label">Permission</label>
                                        <div class="form-group">
                                            <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" type="text" placeholder="Permission Name">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-5">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Child Permission</label>
                                    <div class="form-group col-sm-10 mt-2">
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch1" switch="none"/>
                                            <label for="square-switch1" data-on-label="Yes" data-off-label="No"></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-4" id="parent-input" style="display:none;">
                                    <div class="col-sm-12">
                                        <label for="example-text-input" class="form-label">Parent Permission</label>
                                        <select class="form-select select2" name="parent" id="parent" style="width: 100%">
                                            <option selected=""></option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- end row -->

                                <br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Permission">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection
