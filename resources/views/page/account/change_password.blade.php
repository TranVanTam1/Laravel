@extends('page.account.layout')

@section('content2')                  
    <div class="col-md-9">
        <div class="woocommerce-MyAccount-content">
            <div class="woocommerce-notices-wrapper"></div>
            <form action="{{ route('postChangePassword') }}" method="post">
                @csrf
                @method('PUT')
               
                <div class="row margin-top-30">
                    <div class="col-md-12 customer-form-info">
                        <div class="account-details-head">Thay đổi mật khẩu</div>
                        <fieldset class="account-password-form mm-background-white">
                            <div class="form-group row">
                                <label for="password_current" class="col-md-3 col-form-label">Mật khẩu hiện tại</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password_current" id="password_current" placeholder="Mật khẩu hiện tại (để trống nếu không thay đổi)" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_1" class="col-md-3 col-form-label">Mật khẩu mới</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password_1" id="password_1" placeholder="Mật khẩu mới (để trống nếu không thay đổi)" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_2" class="col-md-3 col-form-label">Xác nhận mật khẩu mới</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Xác nhận mật khẩu mới" />
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-right">
                        <input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="722c2b1ee3" />
                        <input type="hidden" name="_wp_http_referer" value="/tai-khoan-cua-toi/edit-account/" />
                        <br>
                        <input type="submit" class="btn btn-primary" name="save_account_details" value="Lưu thay đổi" />
                        <input type="hidden" name="action" value="save_account_details" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
