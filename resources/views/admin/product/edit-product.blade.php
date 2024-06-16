@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
                <h2 class="my-4">Chỉnh sửa thông sản phẩm</h2>
                <form action="{{ route('admin.postProductEdit', ['id'=>$product->id] ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Tên sản phẩm:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{isset($product)? $product->name :''}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror " id="description" name="description" value="{{isset($product)? $product->description:'' }}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Đơn giá:</label>
                        <input type="text" class="form-control @error('unit_price') is-invalid @enderror" id="pnit_price" name="unit_price" value="{{isset($product)? $product->unit_price:'' }}">
                        @error('unit_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="promotion_price">Giá khuyến mãi:</label>
                        <input type="text" class="form-control @error('promotion_price') is-invalid @enderror" id="promotion_price" name="promotion_price" value="{{isset($product)? $product->promotion_price:'' }}">
                        @error('promotion_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unit">Đơn vị:</label>
                        <select class="form-control  @error('unit') is-invalid @enderror" name="unit" id="">
                            <option value="{{$product->unit}}">{{$product->unit}}</option>
                            <option value="hộp">hộp</option>
                            <option value="cái">cái</option>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="new">Sản phẩm mới:</label>
                        <select class="form-control @error('new') is-invalid @enderror" name="new" id="">
                            <option value="{{$product->new}}">{{$product->new}}</option>
                            <option value="1">1 ( sản phẩm mới )</option>
                            <option value="0">0 ( sản phẩm cũ )</option>
                        
                        </select>
                        
                        @error('new')
                        <div class="alert alert-danger">{{ $message }}</div>
                    </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <img id="product-image-preview" width="150px" height="100px" src="/source/image/product/{{$product->image}}" />
                    </div>
                    <div class="form-group">
                        <label for="image">Hình ảnh:</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{isset($product)? $product->image : '' }}">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Loại sản phẩm:</label>
                        <select class="form-control" name="id_type" id="">
                        @foreach ( $types as $type )
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                        </select>
                    
                    @error('id_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                    </div>
                    
                @enderror
                <br/>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.getProductList') }}" class="btn btn-primary">Quay lại danh sách</a>
                </form>
                
            </div>
        </div>
</div>
<script>
    $(document).ready(function() {
        // Bắt sự kiện thay đổi của input file
        $('#image').change(function() {
            let input = this;
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#product-image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endsection

