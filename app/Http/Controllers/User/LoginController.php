<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\User\CommonService;
use Session;


class LoginController extends Controller
{
    protected $CommonService;

    public function __construct(CommonService $CommonService)
    {
        $this->CommonService = $CommonService;
    }

    public function indexLogin(){
        try {
            $user_email = Session::get('email');
            if(!empty($user_email)){
                return redirect()->route('dashboard');
            }else{
                return view('User.Auth.login');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function login(Request $request){
        try {
            \Log::info($request);
            $user = $this->CommonService->getsingleData('email' , $request->email, 'users');
            if (isset($user)) {
                if (Hash::check($request->password, $user->password)) {
                    Session::put('userId', $user->id);
                    Session::put('email', $user->email);
                    toastr()->success('User logged in successfully!');
                    return redirect()->route('dashboard');
                } else {
                    toastr()->error('Incorrect email or password!');
                    return back();
                }
            } else {
                toastr()->warning('Please fill valid info!');
                return back();
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    public function registration(){
        try {
            $user_email = Session::get('email');
            if(!empty($user_email)){
                return redirect()->route('dashboard');
            }else{
                // return redirect()->url('/user/registration');
                return view('User.Auth.registration ');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function logout(Request $request)
    {
        try {
            Session::flush();
            toastr()->success('User logged out successfully!');
            return redirect('/user/login');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
