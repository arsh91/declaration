<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
		
        return view('auth.login');
    }

	public function login(Request $request)
	{	
		 $credentials = $request->validate([
            'phone' => ['required', 'numeric', 'digits:10'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'credentials_error' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
		
		
	}
	
	 public function logOut() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }	

    public function registerView(Request $request)
	{
        return view('register.index');
    }

    public function registerSave(Request $request)
	{
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'state' => 'required',
            'password' => 'required|confirmed',
        ]);
        $email = null;
        if($request->has('email') && !empty($request->get('email'))){
            $email =  $request->get('email');
        }
 
        $user =Users::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $email,
            'state' => $validated['state'],
            'password' => $validated['password'],
            'role' => 5,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$request->session()->flash('message','Account created successfully!');
        return redirect('/register')->with(['status'=>200]);
    }
}