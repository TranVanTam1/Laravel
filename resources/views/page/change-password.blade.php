@extends('layout.master')

@section('content')
    <div class="container">
        <div id="content">
            <form action="{{ route('change.password') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đổi mật khẩu</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-group">
                            <label for="current_password">Mật khẩu hiện tại</label>
                            <input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" id="current_password">
                            @error('current_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" id="new_password">
                            @error('new_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                            <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
