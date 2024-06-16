@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container mt-5">
        <h1 class="mb-4" style="color: red; text-align: center;">Thêm mới Slide</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('slides.store')}}" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
           
            <div class="form-group">
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                <small id="imageHelp" class="form-text text-muted">Hình ảnh chỉ chấp nhận định dạng: jpg, png, jpeg, gif, svg và kích thước tối đa 5MB.</small>
            </div>

            <div class="form-group">
                <label for="stt">Thứ tự:</label>
                <input type="number" class="form-control" id="stt" name="stt" >
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="{{ route('slides.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function() {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('currentImage').src = e.target.result;
        }

        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection
