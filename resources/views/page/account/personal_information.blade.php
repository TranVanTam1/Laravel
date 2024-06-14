@extends('page.account.layout')
@section('content2')
            
                
                <div class="col-md-9">
                    <div class="woocommerce-MyAccount-content">
                        <div class="woocommerce-notices-wrapper"></div>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-9 customer-form-info">
                                    <div class="account-details-head">Thông tin cá nhân</div>
                                    <fieldset class="mm-background-white">
                                        <div class="form-group row">
                                            <label for="account_last_name" class="col-md-3 col-form-label">Họ và tên <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="account_last_name" id="account_last_name" value="tran van tam" placeholder="Nhập họ và tên"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_display_name" class="col-md-3 col-form-label">Tên hiển thị&nbsp;</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="account_display_name" id="account_display_name" value="vantamtran1233" placeholder="Nhập tên hiển thị" />
                                                <span><em></em></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_email" class="col-md-3 col-form-label">Email <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="account_email" id="account_email" value="vantamtran1233@gmail.com" placeholder="Nhập email" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_phone_number" class="col-md-3 col-form-label">Số điện thoại&nbsp;<span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="account_phone_number" id="account_phone_number" value="0332541961" placeholder="Nhập số điện thoại" />
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