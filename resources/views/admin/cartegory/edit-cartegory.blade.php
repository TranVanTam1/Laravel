@extends('admin.master')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('admin.postCateEdit',['id'=>$cartegory->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" value="{{isset($cartegory)? $cartegory->name :''}}" name="name" placeholder="Please Enter Category Name" />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" value="{{isset($cartegory)? $cartegory->description :''}}" name="description" placeholder="Please Enter description" />
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-default">Save Changes</button>
                    <a href="{{ route('admin.getCateList') }}" class="btn btn-primary">Quay lại danh sách</a>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
