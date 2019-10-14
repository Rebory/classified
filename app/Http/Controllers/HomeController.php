<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $now_date = Carbon::now()->toDateString();
        $my_date = dateFormat($now_date);

        if(Auth::user()->role === 0){
            return view('administrative.super_admin.dashboard');
        }

        if(Auth::user()->role === 1){
            return view('administrative.admin.dashboard');
        }

        if(Auth::user()->role === 2){
            return view('administrative.editor.dashboard');
        }

        if(Auth::user()->role === 3){
            return view('user.home');
        }

    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout () {
        auth()->logout();
        return redirect('/login');
    }




}
