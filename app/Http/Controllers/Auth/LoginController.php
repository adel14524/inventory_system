<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        // Validate the login data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in the user using the provided credentials
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {

            //check authentication
            if(Auth::check())
            {
                $request->session()->regenerate();

                // Authentication successful, flash a success message
                $notification = array(
                    'message' => 'You Have Login Successfully',
                    'alert-type' => 'success'
                );

                // Redirect to the user's dashboard or another desired page
                return redirect(RouteServiceProvider::HOME)->with($notification);
            }

            return redirect('/')->withErrors(['username' => 'Please login to access the dashboard.'])->onlyInput('username');
        }

        return back()->withErrors(['username' => 'Your provided credentials do not match in our records.'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Succesfully',
            'alert-type' => 'success'
        );
        return redirect('/')->with($notification);
    }
}
