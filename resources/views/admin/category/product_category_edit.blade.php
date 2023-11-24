@extends('admin.admin_master')

@section('main')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><b>MANAGE PRODUCT CATEGORY</b></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item fw-bolder"><a href="{{ route('category.all') }}">Product Category Management</a></li>
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
                            <h4 class="card-title"><b>Edit Product Category</b></h4><br><br>

                            <form method="post" action="{{ route('category.update') }}" id="myForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $category->id }}">

                                <div class="row mb-4">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Category</label>
                                    <div class="form-group col-sm-10">
                                        <input name="category_name" class="form-control @error('category_name') is-invalid @enderror" type="text" value="{{ $category->category_name }}">

                                        @error('category_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit Category">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection
