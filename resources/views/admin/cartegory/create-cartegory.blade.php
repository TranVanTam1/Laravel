@extends('admin.master')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{route('admin.postCateAdd')}}" method="POST"  enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Please Enter Category Name" />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Please Enter descriptionr" />
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection