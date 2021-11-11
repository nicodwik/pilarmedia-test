@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Approval</h1>
        
        <div class="card mb-4">
            {{-- @auth
                <div class="card-header">
                    <a href="{{route('inventory.create')}}" class="btn btn-primary">Create</a>
                </div>
            @endauth --}}
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>                            
                            <th>Date</th>                            
                            <th>Status</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($approvals as $approval)
                            <tr>
                                <td>{{$approval->user->name}}</td>
                                <td>{{$approval->type}}</td>
                                <td>{{$approval->date}}</td>
                                <td>{{$approval->status}}</td>
                                <td>
                                    <a href="{{route('approval.detail', base64_encode($approval->id))}}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection