<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\User;
  
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users'
            ], [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required'
            ]);
  
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
      
        return back()->with('success', 'User created successfully.');
    }
}
