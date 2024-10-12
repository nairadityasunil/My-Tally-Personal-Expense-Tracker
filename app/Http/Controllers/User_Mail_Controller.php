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
        $data = compact('all_users','all_mails');
        return view('user_mail_master')->with($data);
    }
}
