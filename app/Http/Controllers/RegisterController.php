<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegisterController extends Controller
{
    public function registerForm()
    { 
        return view('register');
    }
    public function register(Request $request)
    {
       $data=$request->all();
       $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:5', 'confirmed'],
        'mobileno'=>['required','string','min:10','max:10','regex:"^[0-9]*$"']
    ]);
       User::create($data);
       return redirect('home')->with('msg','Welcome '.$request->input('name').' to Our Shop,Please Login and Enjoy Our Product Thank You..!');
    }
}
