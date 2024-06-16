@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container mt-5">
        <h1 class="mb-4" style="color: red; text-align: center;">Quản lý Slide</h1>

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

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                   
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Thứ tự</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                <tr>
                    <td class="align-middle text-center">{{ $slide->id }}</td>
                   
                    <td class="align-middle text-center">
                        <img src="/images/slide/{{ $slide->image }}" alt="{{ $slide->title }}"
                            style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td class="align-middle text-center">{{ $slide->stt }}</td>
                    <td class="align-middle text-center">
                        <a href="{{ route('slides.edit', ['slide' => $slide->id]) }}"
                            class="btn btn-sm btn-primary">Chỉnh sửa</a>
                        <form action="{{ route('slides.destroy', ['slide' => $slide->id]) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xoá slide này không?')">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
