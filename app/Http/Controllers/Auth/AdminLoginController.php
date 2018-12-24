<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * This controller doesn't have form for 'register' because
     * usually only superuser can add new employer into the system
     * Use tinker to manually add user into database:
     * >php artisan tinker
     * >>> $admin = new App\Employer
     * >>> $admin->name = "FengYao"
     * >>> $admin->email = "fengyao@devmail.com"
     * >>> $admin->password = Hash::make('password')
     * >>> $admin->job_title = "computer engineer"
     * >>> $admin->save()
     */

    public function __construct()
    {
        // only employers can access this controller
        $this->middleware('guest:admin');
    }
    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function login(Request $request) {
        // validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // attempt to log in the user
        // Auth::attempt($credentials, $remember)
        // returns true or false
        // attempt automatically handles checking the hashed passwords in DB, 
        // so we do not need to worry about that
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        // if not successful, then redirect back 
        // to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
