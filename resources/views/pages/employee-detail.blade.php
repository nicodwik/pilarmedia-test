@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="my-4">Employee Detail</h1>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="">Name</label>
                    <h5>{{$employee->name}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Email</label>
                    <h5>{{$employee->email}}</h5>
                </div>
                <hr>
                <div class="form-group mb-4">
                    <label for="">Presences this month</label>
                    <h5>{{$employee->presences_total->where('type', 'presence')->count()}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Away this month</label>
                    <h5>{{$employee->presences_total->where('type', 'away')->count()}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Sick this month</label>
                    <h5>{{$employee->approvals->where('type', 'sick_leave')->count()}}</h5>
                </div>
                <div class="form-group mb-4">
                    <label for="">Paid Leave this month</label>
                    <h5>{{$employee->approvals->where('type', 'paid_leave')->count()}}</h5>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                Presences Total
            </div>
           <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Type</th>                             
                            <th>Time</th>
                            <th>Location</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employee->presences_total as $presence)
                            <tr>
                                <td>{{$presence->type}}</td>
                                <td>{{$presence->time}}</td>
                                <td>{{$presence->location}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
           </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Approvals Total
            </div>
           <div class="card-body">
                <table id="datatablesSimple2">
                    <thead>
                        <tr>
                            <th>Type</th>                            
                            <th>Date</th>                            
                            <th>Reason</th>                            
                            <th>Status</th>                            
                            <th>Created At</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employee->approvals as $approval)
                            <tr>
                                <td>{{$approval->type == 'sick_leave' ? 'Sick Leave' : 'Paid Leave'}}</td>
                                <td>{{\Carbon\Carbon::parse($approval->date)->format('d M Y')}}</td>
                                <td>{{$approval->reason}}</td>
                                <td>{{$approval->status}}</td>
                                <td>{{$approval->created_at}}</td>
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