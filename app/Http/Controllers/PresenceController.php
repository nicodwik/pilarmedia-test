<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Presence;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function presence(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'pin' => 'required|digits:5',
            'lat' => 'required',
            'long' => 'required',
        ]);

        $loc = \Http::get('https://api.opencagedata.com/geocode/v1/json?q='. $request->lat .'+'. $request->long .'&key=051de8de46204e1eb64ca1119fe800e5')->json();
        $locData = $loc['results'][0]['components'];
        $village = $locData['village'] ?? '-';
        $city = $locData['county'] ?? '-';
        $province = $locData['state'] ?? '-';
        
        $employee = User::where('email', $validated['email'])->where('pin', $validated['pin'])->where('role', 'employee')->first();
        if(!$employee) return redirect()->back()->with('result', 'danger|email / PIN invalid, try again');

        $time = Carbon::now();
        $startOfDay = $time->copy()->startOfDay();
        $endOfDay = $time->copy()->endOfDay();
        $maxPresenceTime = Carbon::createFromTimeString('09:00');
        $startAwayTime = Carbon::createFromTimeString('17:00');

       
        if($time->between($startOfDay, $maxPresenceTime) || $time->between($startAwayTime, $endOfDay)) {
            $type = 'presence';

            if($time->between($startAwayTime, $endOfDay)) {
               $type = 'away';
            }

            $isPresenced = Presence::where('employee_id', $employee->id)->whereDate('time', date('Y-m-d'))->where('type', $type)->first();
            if ($isPresenced) return redirect()->back()->with('result', 'danger|You have ' . $type . ' today, no need to re-' . $type);
    
            Presence::insert([
                'employee_id' => $employee->id,
                'time' => $time->copy()->now(),
                'type' => $type,
                'location' => $village . ', ' . $city . ', ' . $province
            ]);
    
            return redirect()->back()->with('result', 'success|' . $type . ' success at ' . $time . '. Have a good day :)');
        }

        Presence::insert([
            'employee_id' => $employee->id,
            'time' => $time->copy()->now(),
            'type' => 'invalid',
        ]);

        return redirect()->back()->with('result', 'danger|Presence / away time is not allowed');
    }

    public function index()
    {
        if(\Auth::user()->role == 'employee') {
            abort(403);
        }
        
        $presences = Presence::whereBetween('time', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->with(['user'])->orderByDesc('time')->get();
        
        return view('pages.presences', compact('presences'));
    }
}
