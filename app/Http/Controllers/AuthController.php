<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function registration(){
        return view('auth.registration');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email' , 'password');
        if (Auth::attempt($credentials)){
            return redirect()->intended('dashboard')
                             ->withSuccess('You have successfully loggedin!');
        }
        else{
            return redirect("login")->withSuccess('Opps! you have entered invalid credentials');
        }
    }
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        Auth::login($check);

        return redirect("dashboard")->withSuccess('Great! you have Successfully registered!');
    }
    public function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function dashboard(){
        if(Auth::check()){
            return view('auth.dashboard');
        }
        return redirect("login")->withSuccess('Opps! you do not have access');
    }
    public function logout(){
        session::flush();
        Auth::logout();

        return redirect('login');
    }
}
