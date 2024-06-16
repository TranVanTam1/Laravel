@extends('admin.master')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
                </h1>
            </div>
            @if (session('success'))
            <div class="alert alert-danger">
                {{ session('validation') }}
            </div>
        @endif
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{ route('admin.postUserAdd') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control @error('full_name') is-invalid @enderror" name="full_name" placeholder="Please Enter Full Name" />
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Please Enter Email" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div><div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Please Enter password" />
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Please Enter Phone Number" />
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Please Enter Address" />
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <select class="form-control @error('level') is-invalid @enderror" name="level">
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                            <option value="3">User</option>
                        </select>
                        @error('level')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-default">User Add</button>
                    <a href="{{ route('admin.getUserList') }}" class="btn btn-primary">Quay lại danh sách</a>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection
