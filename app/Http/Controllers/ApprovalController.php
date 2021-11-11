<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Approval;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    public function index()
    {
        if(\Auth::user()->role == 'employee') {
            abort(403);
        }
        
        $approvals = Approval::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->with(['user'])->orderByDesc('created_at')->get();
        
        return view('pages.approval', compact('approvals'));
    }

    public function detail($id)
    {
        if (\Auth::user()->role == 'employee') {
            abort(403);
        }
        
        $approval = Approval::where('id', base64_decode($id))->with(['user'])->first();

        return view('pages.approval-detail', compact('approval'));
    }

    public function approvalStore(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'pin' => 'required|digits:5',
            'date' => 'required|date',
            'reason' => 'required',
            'type' => 'required',
        ]);

        $employee = User::where('email', $data['email'])->where('pin', $data['pin'])->where('deleted_at', null)->first();
        if (!$employee) return redirect()->back()->with('result', 'danger|email / PIN invalid, try again');

        if($data['type'] == 'paid_leave') {
            if(Carbon::parse($data['date'])->startOfDay() < Carbon::now()->addDays(1)->startOfDay()) return redirect()->back()->with('result', 'danger|Paid leave approval must be applied max H-1');
        }

        Approval::create([
            'employee_id' => $employee->id,
            'type' => $data['type'],
            'date' => $data['date'],
            'reason' => $data['reason'],
            'status' => 'pending',
        ]);

        return redirect()->back()->with('result', 'success|Form has been submitted, please wait for approval');
    }

    public function approvalAction(Request $request, $id)
    {
        if (\Auth::user()->role == 'employee') {
            abort(403);
        }

        $approval = Approval::where('id', base64_decode($id))->first();
        // dd($request->type);
        if (!$approval) return redirect()->back()->with('result', 'danger|invalid data, try again');

        if($approval->status == 'pending') {
            $approval->update([
                'status' => $request->type
            ]);
        }

        return redirect()->back()->with('result', 'success|Action Success');
    }
}
