<?php

namespace App\Http\Controllers\Auth;

use App\LoginDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Location;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    //protected $redirectTo = '/home';  //overwrite by me


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        //dd($request->email ,  $request->password );
        if($this->guard()->validate($this->credentials($request))) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1])) {
                // return redirect()->intended('dashboard');
                $ip = request()->ip();
                $localMachineIP = '::1';
                if($ip == $localMachineIP){ $ip = '127.0.0.1'; }
                $location = Location::get($ip);
                $data = [
                    'user_id'   => Auth::user()->id,
                    'device_ip' => $ip,
                    'details' => $ip .'  '. $location->cityName .'  '. $location->countryCode ,
                ];
                (new LoginDetail())->create($data);
                return redirect()->route('home');

            }  else {
                $this->incrementLoginAttempts($request);
                return redirect()->back()->with('msg', 'This account is not activated.');
                //return response()->json(['error' => 'This account is not activated.'], 401);
            }
        } else {
            $this->incrementLoginAttempts($request);
            //return response()->json([ 'error' => 'Credentials do not match our database.' ], 401);
            return redirect()->back()->with('error', 'Access denied.');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
