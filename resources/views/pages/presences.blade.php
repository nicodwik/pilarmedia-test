@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Presence</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>                            
                            <th>Date</th>                            
                            <th>Location</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presences as $presence)
                            <tr>
                                <td>{{$presence->user->name}}</td>
                                <td>{{$presence->type}}</td>
                                <td>{{$presence->time}}</td>
                                <td>{{$presence->location}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection