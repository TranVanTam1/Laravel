@extends('admin.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                        
                        <p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <br/>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Desription</th>
                                <th>image</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($types)
                                @foreach ($types as $type )
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$type->id}}</td>
                                        <td>{{$type->name}}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($type->description, 30, '...') }}</td>
                                        <td class="align-middle text-center"><img style="width: 100px;height: 70px;" src="/source/image/product/{{$type->image}}"></td>
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

    </div>
    <!-- /#wrapper -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
        </script>
    @endsection