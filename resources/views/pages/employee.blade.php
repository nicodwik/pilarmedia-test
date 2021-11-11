@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Employee</h1>
        
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
                            <th>Email</th>                            
                            <th>Presences this month</th>                            
                            <th>Away this month</th>                            
                            <th>Sick permission this month</th>                            
                            <th>Paid leave this month</th>                            
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->presences_count ?? 0}}</td>
                                <td>{{$user->aways_count ?? 0}}</td>
                                <td>{{$user->sicks_count ?? 0}}</td>
                                <td>{{$user->paid_leaves_count ?? 0}}</td>
                                <td>
                                    <a href="{{route('employee.detail', base64_encode($user->id))}}" class="btn btn-primary">Detail</a>
                                    {{-- <form action="{{route('inventory.destroy', base64_encode($inventory->id))}}" method="post">
                                        <a href="{{route('inventory.edit', base64_encode($inventory->id))}}" class="btn btn-dark">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>    
                                    </form>     --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection