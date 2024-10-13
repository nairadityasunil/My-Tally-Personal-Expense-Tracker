<?php

namespace App\Http\Controllers;

use App\Models\User_master;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login_page()
    {
        if(session()->has('username'))
        {
            session()->forget('username');
        }
        return view('login_page');
    }

    public function authenticate_user(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];

        // Return the first occurance 
        $find_user = User_master::where('username', '=', $username)->first();

        if ($find_user) {
            // If a match is found in the database

            $db_password = $find_user->password;
            $password = md5($password);
            if ($db_password == $password) {
                // If the user is authentic then store the user details in the session
                $request->session()->put('username', $username); // Storing username in session
                if ($request->session()->has('username')) {
                    return redirect('/home');
                }
            } else {
                // Password does not match
                session()->flash('status', '* Invalid Login Credentials *');
                return redirect('/');
            }
        } else {
            // Password does not match
            session()->flash('status', '* Invalid Login Credentials *');
            return redirect('/');
        }
    }

}
