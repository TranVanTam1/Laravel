@extends('page.account.layout')

@section('content2')                  
    <div class="col-md-9">
        <div class="woocommerce-MyAccount-content">
            <div class="woocommerce-notices-wrapper"></div>
            <form action="{{route('postUpdatePersonalInformation')}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9 customer-form-info">
                        <div class="account-details-head">Thông tin cá nhân</div>
                        <fieldset class="mm-background-white">
                            <div class="form-group row">
                                <label for="account_last_name" class="col-md-3 col-form-label">Họ và tên <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="account_last_name" id="account_last_name" value="{{ $user->full_name }}" placeholder="Nhập họ và tên"/>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="account_email" class="col-md-3 col-form-label">Email <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="account_email" id="account_email" value="{{ $user->email }}" placeholder="Nhập email" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="account_phone_number" class="col-md-3 col-form-label">Số điện thoại&nbsp;<span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="account_phone_number" id="account_phone_number" value="{{ $user->phone }}" placeholder="Nhập số điện thoại" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label">Địa chỉ&nbsp;<span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" placeholder="Nhập địa chỉ" />
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3 mm-tp-and-p">
                        <div class="account-details-head">Điểm tích lũy</div>
                        <div class="mm-total-point mm-account-total">
                            <img src="https://online.mmvietnam.com/wp-content/themes/yozi-child/assets/icon/totalpoint.png"  alt="">
                            <div class="mm-des">
                                Danh thu tính điểm trong tháng
                            </div>
                            <div class="mm-num mm-price">
                                0
                            </div>
                            <div class="mm-metas">(Điểm)</div>
                        </div>
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
