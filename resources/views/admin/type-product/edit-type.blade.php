@extends('admin.master')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại sản phẩm
                    <small>Chỉnh sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('admin.postTypeEdit', ['id' => $type->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Tên loại sản phẩm</label>
                        <input class="form-control @error('name') is-invalid @enderror" value="{{ $type->name }}" name="name" placeholder="Please Enter Category Name" />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" value="{{ $type->description }}" name="description" placeholder="Please Enter description" />
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
                        <img id="product-image-preview" width="150px" height="100px" src="/images/type-product/{{ $type->image }}" />
                    </div>
                    <div class="form-group">
                        <label for="cartegory_id">Cartegory ID</label>
                        <select class="form-control @error('cartegory_id') is-invalid @enderror" id="cartegory_id" name="cartegory_id">
                            @foreach ($cartegorys as $cartegory)
                                <option value="{{ $cartegory->id }}" {{ $type->cartegory_id == $cartegory->id ? 'selected' : '' }}>{{ $cartegory->name }}</option>
                            @endforeach
                        </select>
                        @error('cartegory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-default">Save Changes</button>
                    <a href="{{ route('admin.getTypeList') }}" class="btn btn-primary">Quay lại danh sách</a>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<script>
    // JavaScript code for image preview
    document.getElementById("image").addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("product-image-preview").setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
<!-- /#page-wrapper -->
@endsection
