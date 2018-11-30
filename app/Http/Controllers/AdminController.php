<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Time;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.login');
    }

    public function change(Request $request)
    {
        return view('admin.change');
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('name', $request->input('username'))->first();
        if(!is_null($user)) {
            if (Hash::check($request->input('password'), $user->password)) {
                $apikey = base64_encode(str_random(40));
                Users::where('name', $request->input('username'))->update(['api_key' => "$apikey"]);
                $request->session()->put('apikey', $apikey);
                return redirect()->to('/admin/home');
            } else {
                return redirect()->to('/admin/login');
            }
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function home(Request $request)
    {
        $days = Time::all();
        return view('admin.home', compact('days'));
    }

    public function getTime(Request $request)
    {
        $time = Time::where('day', $request->day)->first();
        $startTime = $time->start_time;
        $endTime = $time->end_time;

        return response()->json(['success' => true, 'startTime' => $startTime, 'endTime' => $endTime]);
    }

    public function editTime(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $day = $request->day;

        Time::where('day', $request->day)->update([
            'start_time' => $start,
            'end_time' => $end
        ]);

        return response()->json(['success' => true]);
    }

    public function logout(Request $request)
    {
        $request->session()->put('apikey', '');
        return redirect()->to('/admin/login');
    }
}
