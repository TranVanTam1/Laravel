<!-- create.blade.php -->

@extends('admin.master')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Coupon Code</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.coupons.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Coupon Code:</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Enter coupon code" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount_percent">Discount (%)</label>
                                    <input type="number" class="form-control @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent" placeholder="Enter discount percentage" value="{{ old('discount_percent') }}">
                                    @error('discount_percent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="valid_from">Valid From:</label>
                                    <input type="date" class="form-control @error('valid_from') is-invalid @enderror" id="valid_from" name="valid_from" value="{{ old('valid_from') }}">
                                    @error('valid_from')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="valid_to">Valid To:</label>
                                    <input type="date" class="form-control @error('valid_to') is-invalid @enderror" id="valid_to" name="valid_to" value="{{ old('valid_to') }}">
                                    @error('valid_to')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
