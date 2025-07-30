<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|numeric',
            'password' => 'required',
        ]);
        $credentials = [
            'mobile_no' => $request->input('mobile_no'),
            'password' => $request->input('password'),
            'status' => 1,
            // 'is_user_verified' => 1,
        ];
        $auth_user = Auth::attempt($credentials);
        // dd($auth_user);
        if ($auth_user) {
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'mobile_no' => 'Invalid mobile number or password, or account not verified.',
        ])->withInput($request->except('password'));

    }

}
