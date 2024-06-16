@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-danger">
                {{ session('validation') }}
            </div>
        @endif
                    <h2 class="my-4">Tạo sản phẩm mới</h2>
                    <form action="{{ route('admin.postProductAdd') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên sản phẩm:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả:</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Đơn giá:</label>
                            <input type="text" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price">
                            @error('unit_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="promotion_price">Giá khuyến mãi:</label>
                            <input type="text" class="form-control @error('promotion_price') is-invalid @enderror" id="promotion_price" name="promotion_price">
                            @error('promotion_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="unit">Đơn vị:</label>
                            <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
                                <option value=""></option>
                                <option value="hộp">hộp</option>
                                <option value="cái">cái</option>
                            </select>
                            @error('unit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="new">Sản phẩm mới:</label>
                            <select class="form-control @error('new') is-invalid @enderror" id="new" name="new">
                                <option value=""></option>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                            @error('new')
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
                            <label for="id_type">Loại sản phẩm:</label>
                            <select class="form-control @error('id_type') is-invalid @enderror" id="id_type" name="id_type">
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('id_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                        <a href="{{ route('admin.getProductList') }}" class="btn btn-primary">Quay lại danh sách</a>

                    </form>
        </div>
    </div>
</div>
@endsection
