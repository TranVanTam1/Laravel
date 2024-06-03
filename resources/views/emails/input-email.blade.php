@extends('layout.master')
@section('content')
<div class="container">
  <div class="row" style="height:300px; max-width: 500px; margin: auto;padding: 10px;">
      <div class="column">
          <div class="login-form">
              <form action="{{ route('postInputEmail') }}" method="POST">
                  @csrf
                  <h1>Reset mật khẩu</h1><br>
                      <i></i>
                      <input name="txtEmail" type="text" placeholder="Nhập địa chỉ email của bạn để nhận mật khẩu mới" value="{{ old('txtEmail') }}">
                      <span class="error">
                          @error('txtEmail')
                              {{ $message }}
                          @enderror
                      </span>
                  </div>
                  <br>
                  <div class="btn-box">
                      <input type="submit" class="btn btn-submit" value="Nhận mật khẩu" name="btnGetPassword" />
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>




@endsection