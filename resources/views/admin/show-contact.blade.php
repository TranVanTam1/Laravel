@extends('admin.master')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Contact Message</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Ngày gửi :</strong> {{ $contact->created_at }}
                        </div>
                        <div class="mb-3">
                            <strong>Name :</strong> {{ $contact->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email :</strong> {{ $contact->email }}
                        </div>
                        <div class="mb-3">
                            <strong>Subject :</strong> {{ $contact->subject }}
                        </div>
                        <div class="mb-3">
                            <strong>Message :</strong> {{ $contact->message }}
                        </div>
                        
                        <hr>
                        <h3>Send Response</h3>
                        <form action="{{ route('admin.send_response',['id'=>$contact->id] )}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="response">Response</label>
                                <textarea class="form-control" id="response" name="response" rows="3"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Send Response</button>
                   

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
