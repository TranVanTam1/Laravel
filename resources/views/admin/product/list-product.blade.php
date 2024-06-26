
@extends('admin.master')
@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container mt-5 " >
                <h1 class="mb-4" style="color: red; text-align: center;">Danh sách các sản phẩm</h1>
                
                <br>
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Unit price</th>
                        <th class="text-center">Pro price</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">New</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($products)
                        @foreach($products as $product)
                            <tr>
                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">{{ $product->id }}</td>
                                <td class="align-middle text-center">{{ $product->name }}</td>
                                <td class="align-middle text-center"><img style="width: 100px;height: 70px;" src="/images/product/{{$product->image}}"></td>
                                <td class="align-middle">{{ \Illuminate\Support\Str::limit($product->description, 10, '...') }}</td>
                                <td style="min-width: 100px " class="align-middle text-center">{{ $product->unit_price }}</td>
                                <td style="min-width: 100px " class="align-middle text-center">{{ $product->promotion_price }}</td>
                                <td class="align-middle text-center">{{ $product->unit }}</td>
                                <td class="align-middle text-center">{{ $product->new }}</td>
                                <td  style="min-width: 100px " class="align-middle text-center">{{ $product->type->name }}</td>
                              
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.getProductEdit', ['id'=>$product->id] ) }}">Edit</a></td>
                               
                                <td>
                                    <form class="d-inline " action="{{ route('admin.getProductDelete',['id'=>$product->id] ) }}" method="POST" id="delete-form">
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
                {{ $products->links() }}
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