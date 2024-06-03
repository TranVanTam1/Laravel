@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h2>Contacts of Customers</h2>
            <div class="table-responsive">
                @if(count($contacts) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th> <!-- Thêm cột số thứ tự -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                    @endphp
                        @foreach($contacts as $contact)
                        
                        <tr class="contact-row @if(!$contact->viewed) font-weight-bold @endif">
                            <td>{{$i++}}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>{{ $contact->status  }}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.show-contact',['id'=>$contact->id] ) }}">Show Detail</a></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No contacts found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS cho hiệu ứng hover */
    .contact-row:hover {
        background-color: #f0f0f0;
        cursor: pointer;
    }
</style>
@endsection
