<?php

namespace App\Http\Controllers;


use App\Location;
use App\LoginDetail;
use App\Mail\WelcomeUser;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Auth;
class UserController extends Controller
{
    use Notifiable;
    private $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('role',  '!=' , 0)->orderBy('id', 'desc')->paginate(25);
        return view('administrative.super_admin.tasks.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $userRoleOptions = $this->_user->userRoleOptions();
        $locationList    = (new Location())->locationOptionsByID();
        return view('administrative.super_admin.tasks.users.create', compact('userRoleOptions', 'locationList'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! You have no right to create role.'] ]);
        }

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:100',
            'last_name'             => 'nullable|max:100',
            'email'                 => 'required|email|unique:users,email|max:100',
            'mobile_number'         => 'required|regex:/^[0-9]{10,15}+$/',
            'password'              => 'required|min:8|max:25',
            'role'                  => 'required|max:2',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'first_name' => $request->first_name,
                'last_name' => ($request->has('last_name')) ? $request->last_name : null,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'userpass' => $request->password,
                'location_id' => $request->location,
            ];
            Mail::to($data['email'])->Send(new WelcomeUser($data));
            $userId = $this->_user->store($data);

           // $hotel = Hotel::where('user_id', $userId)->first();
            // if role hotel_admin // create hotel
//            if ($request->role == 1) {
//                if ($hotel == null){
//                    $data2 = [
//                        'user_id'     => $userId,
//                        'hotel_name'  => $request->name,
//                        'email'       => $request->email,
//                        'location_id' => $request->location,
//                    ];
//                    (new Hotel)->create($data2); //create hotel profile
//                }
//            }
            return response()->json(['success' => 'User Create Successfully.']);
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $userRoleOptions = $this->_user->userRoleOptions();
        $locationList    = (new Location())->locationOptionsByID();
        return view('administrative.super_admin.tasks.users.edit', compact('user' ,'userRoleOptions' , 'locationList'));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user, Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! You have no right to create role.'] ]);
        }

        $validator = Validator::make($request->all(), [
            'first_name'            => 'required|max:100',
            'last_name'             => 'nullable|max:100',
            'email'                 => 'required|email|max:100|unique:users,email,'.$user->id.',id',
            'mobile_number'         => 'required|regex:/^[0-9]{10,15}+$/',
            'password'              => 'nullable|min:8|max:25',
            'role'                  => 'required|max:2',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => ($request->has('last_name')) ? $request->last_name : null,
                'email'                  => $request->email,
                'mobile_number'          => $request->mobile_number,
                'password'               => ($request->has('password')) ? bcrypt($request->password) : $user->password,
                'role'                   => $request->role,
                'location_id'           => $request->location
            ];
            $this->_user->store($data , $user->id);
            return response()->json(['success' => 'User Update Successfully.']);
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! You have no right to do this.'] ]);
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Delete successfully.');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activation(Request $request)
    {
        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! You have no right to create role.'] ]);
        }

        if($request->has('is_active')) {
            $model= User::findOrFail($request->user_id);
            if ($model->is_active == 1) {
                $model->is_active = 0;
                $model->update();
                return response()->json(['success' => ['User ban Successfully.'] ]);
            } else {
                $model->is_active = 1;
                $model->update();
                return response()->json(['success' => ['User revoked Successfully.'] ]);
            }
        }

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myProfile()
    {
        return view('general.profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        $validator = Validator::make($request->all(), [
            'currant_pass'     => 'required||min:8|max:25',
            'new_pass'         => 'required||min:8|max:25',
            'confirm_pass'     => 'required||min:8|max:25',
        ],
            [
                'currant_pass.required' => 'Currant Password is required.',
                'new_pass.required' => 'New Password is required.',
                'confirm_pass.required' => 'Confirm Password is required.',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            $user = User::findOrFail(Auth::user()->id);
            if(Hash::check($request->currant_pass ,$user->password)) {
                if ($request->new_pass === $request->confirm_pass) {
                    $data = ['password' => bcrypt($request->new_pass)];
                    $this->_user->store($data, $user->id);
                    return response()->json(['success' => 'Password Update Successfully.']);
                } else {
                    return response()->json(['error' => ['New Password or Confirm password not match ']]);
                }
            }else{
                return response()->json(['error' => [' Currant password not match'] ]);
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logDetails()
    {
        $login_details = LoginDetail::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->take(15)->get();
        //return view('general.login-details', compact('login_details'));
    }

}//main
