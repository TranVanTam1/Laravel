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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <a href="{{ route('admin.show-contact',['id'=>$contact->id] ) }}">
                            <tr class="contact-row @if(!$contact->viewed) font-weight-bold @endif">
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>{{ $contact->status  }}</td>
                                <td>
                                    <a href="{{ route('admin.show-contact',['id'=>$contact->id] ) }}" class="btn btn-primary mb-3">Show Detail</a>
                                </td>
                            </tr>
                        </a>
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
