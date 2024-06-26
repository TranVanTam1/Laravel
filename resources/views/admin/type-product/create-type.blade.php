@extends('admin.master')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại sản phẩm
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{route('admin.postTypeAdd')}}" method="POST"  enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label>Tên loại sản phẩm</label>
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
                    <div class="form-group">
                        <label for="image">Hình ảnh:</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="cartegory ID">Cartegory ID</label>
                        <select class="form-control @error('cartegory_id') is-invalid @enderror" id="cartegory_id" name="cartegory_id">
                            @foreach ($cartegorys as $cartegory )
                            <option value="{{$cartegory->id}}">{{$cartegory->name}}</option>
                          
                       @endforeach
                      
                    </select>
                        @error('cartegory_id')
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