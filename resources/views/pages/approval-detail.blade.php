@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Approval Detail</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="">Name</label>
                    <h5>{{$approval->user->name}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Email</label>
                    <h5>{{$approval->user->email}}</h5>
                </div>
                <hr>
                <div class="form-group mb-4">
                    <label for="">Type</label>
                    <h5>{{$approval->type}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Date</label>
                    <h5>{{$approval->date}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Status</label>
                    <h5>{{$approval->status}}</h5>
                </div>
                @if ($approval->status == 'pending')
                    <div>
                        <a href="{{base64_encode($approval->id)}}/action?type=approved" class="btn btn-primary">Accept</a>
                        <a href="{{base64_encode($approval->id)}}/action?type=declined" class="btn btn-danger">Decline</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection