<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        if(\Auth::user()->role == 'employee') {
            abort(403);
        }
        
        $employees = User::where('role', 'employee')->withCount(['sicks', 'presences', 'paid_leaves', 'aways'])->orderByDesc('created_at')->get();
        
        return view('pages.employee', compact('employees'));
    }

    public function detail($id)
    {
        if (\Auth::user()->role == 'employee' && \Auth::user()->id != base64_decode($id)) {
            abort(403);
        }
        
        $employee = User::where('id', base64_decode($id))->where('role', 'employee')->with(['presences_total', 'approvals'])->first();
        // dd($employee);
        return view('pages.employee-detail', compact('employee'));
    }
}
