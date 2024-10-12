<?php

namespace App\Http\Controllers;
use App\Models\All_transaction;
use App\Models\Payable;
use App\Models\Recievable;
use App\Models\Personal_expense;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $current_date = Carbon::now();
        $current_date = $current_date->toDateTimeString();
        $current_date = Str::substr($current_date , 0 ,10);

        // To get expense of this month
        $this_month = Personal_expense::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        $total_this_month = 0;
        foreach($this_month as $tm)
        {
            $total_this_month = $total_this_month + $tm->amount;
        }

        // Personal Expense Today
        $personal_today = Personal_expense::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
        $per_today = 0;
        foreach($personal_today as $pet)
        {
            $per_today = $per_today + $pet->amount;
        }

        // To get all received today
        $recd_today = All_transaction::where('action','=','received')->whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
        $r_today = 0;
        foreach($recd_today as $rt)
        {
            $r_today = $r_today + $rt->amount;
        }


        // To get all paid today
        $paid_today = All_transaction::where('action','=','paid')->whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();
        $p_today = 0;
        foreach($paid_today as $pt)
        {
            $p_today = $p_today + $pt->amount;
        }

        // Total Receivables
        $total_receivables = Recievable::all();
        $t_rec = 0;
        foreach($total_receivables as $tot_re)
        {
            $t_rec = $t_rec + $tot_re->amount;
        }

        // Total Payables
        $total_payable = Payable::all();
        $t_pay = 0;
        foreach($total_payable as $tot_p)
        {
            $t_pay = $t_pay + $tot_p->amount;
        }

        $data = compact('total_this_month','r_today','p_today','per_today','t_rec','t_pay','this_month','personal_today','recd_today','paid_today','total_receivables','total_payable');
        return view('home')->with($data);

    }
}
