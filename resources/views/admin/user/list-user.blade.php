@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>
             
            <br>
                
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
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Username</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Level</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($users)
                    @foreach ($users as $user )
                        
                    
                    <tr class="odd gradeX" align="center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->full_name}}</td>
                        @php
                            $emailParts = explode('@', $user->email);
                            $username = $emailParts[0];
                            $domain = $emailParts[1];

                            $hiddenUsername = substr($username, 0, -3) . '***';
                            $hiddenEmail = $hiddenUsername . '@' . $domain;
                        @endphp
                        <td>{{ $hiddenEmail }}</td>
                        <td>{{ substr($user->phone, 0, -3) }}XXX</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->level}}</td>             
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.getUserEdit', ['id'=>$user->id] ) }}">Edit</a></td>
                        <td>
                            <form class="d-inline " action="{{ route('admin.getUserDelete',['id'=>$user->id] ) }}" method="POST" id="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                        
                    @endisset
                    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection