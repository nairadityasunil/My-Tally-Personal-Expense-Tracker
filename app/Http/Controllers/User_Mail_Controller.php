<?php

namespace App\Http\Controllers;

use App\Models\User_master;
use App\Models\Mail_master;
use Illuminate\Http\Request;

class User_Mail_Controller extends Controller
{
    public function user_mail_master()
    {
        $all_users = User_master::all();
        $all_mails = Mail_master::all();
        $data = compact('all_users', 'all_mails');
        return view('user_mail_master')->with($data);
    }

    public function update_details($id)
    {
        $details = User_master::find($id);
        $data = compact('details');
        return view('update_user')->with($data);
    }

    public function save_user_update(Request $request)
    {
        $request->validate(
            [
                'old_username' => 'required',
                'old_password' => 'required'
            ],
            [
                'old_username.required' => '* Please Enter Old Username *', 
                'old_password.required' => '* Please Enter Old Password *' 
            ]
        );
        $old_username = $request['old_username'];
        $old_password = md5($request['old_password']);
        // $old_password = $request['old_password'];?
        $new_username = $request['new_username'];
        $new_password = md5($request['new_password']);

        $user_details = User_master::where('username', '=', "$old_username")->first();
        if ($user_details) {
            // If any matching record is found
            $db_password = $user_details->password;
            if ($old_password == $db_password) {
                // Username and password both are correct
                $email = $request['email'];
                // $update_user = new User_master();
                if ($new_username != "") {
                    $user_details->update([
                        "username" => $new_username
                    ]);
                }
                if ($new_password != "") {
                    $user_details->update([
                        "password" => $new_password
                    ]);
                }

                $user_details->update([
                    'email' => $email
                ]);
                session()->flash('status', '* User Updated *');
            } else {
                session()->flash('status', '* Invalid Password Credentials *');
            }
        } else {
            session()->flash('status', '* Invalid Login Credentials *');
        }
        return redirect('/user_mail_master');
    }
}
