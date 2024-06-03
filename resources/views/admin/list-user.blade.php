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
                       
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
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