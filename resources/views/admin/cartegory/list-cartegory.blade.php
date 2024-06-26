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
                            
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($cartegorys)
                                @foreach ($cartegorys as $cartegory)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$cartegory->id}}</td>
                                        <td>{{$cartegory->name}}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($cartegory->description, 30, '...') }}</td>
                                    
                                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('admin.getCateEdit',['id'=>$cartegory->id] )}}">Edit</a></td>
                                        <td>
                                            <form class="d-inline " action="{{ route('admin.getCateDelete',['id'=>$cartegory->id] ) }}" method="POST" id="delete-form">
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