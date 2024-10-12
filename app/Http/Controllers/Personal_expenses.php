<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Personal_expense;
use App\Models\All_transaction;


class Personal_expenses extends Controller
{
    public function view_all_personal_expense()
    {
        $all_expenses = Personal_expense::all();
        $data = compact('all_expenses');
        return view('all_personal_expenses')->with($data);
    }

    public function new_personal_expense()
    {
        $current_date = Carbon::now();
        $current_date = $current_date->toDateTimeString();
        $current_date = Str::substr($current_date , 0 ,10);
        $todays_expenses = Personal_expense::whereBetween('created_at', [$current_date.' 00:00:00', $current_date.' 23:59:59'])->get();

        $todays_total = 0;
        foreach($todays_expenses as $exp)
        {
            $todays_total = $todays_total + $exp->amount;
        }

        $data = compact('todays_expenses','todays_total');
        return view('new_personal_expense')->with($data);
    }

    public function search_personal_expense(Request $request)
    {
        $name = $request['name'];
        $all_expense = Personal_expense::where('name' , 'LIKE' , "%$name%")->get();
        $data = compact('all_expense' , 'name');
        return view('all_personal_expenses')->with($data);
    }

    public function update_personal_expense($id)
    {
        $entry_id = Personal_expense::find($id);
        $all_expenses = Personal_expense::all();
        $data = compact('all_expenses','entry_id');
        return view('update_personal_expense')->with($data);
    }

    public function save_personal_expense(Request $request)
    {
        // Create a new transaction
        $transaction = new All_transaction();
        $transaction->name = $request->input('name');
        $transaction->purpose = $request->input('purpose');
        $transaction->action = "paid";
        $transaction->mode = $request->input('mode');
        $transaction->amount = $request->input('total_amount');

        // Save the transaction
        if($transaction->save())
        {
            $transactionId = $transaction->id;
            // Inerting into personal expense table
            $new_personal_exp = new Personal_expense();
            $new_personal_exp->name = $request->input('name');
            $new_personal_exp->purpose = $request->input('purpose');
            $new_personal_exp->mode = $request->input('mode');
            $new_personal_exp->amount = $request->input('total_amount');
            $new_personal_exp->transaction_id = $transactionId;

            if($new_personal_exp->save())
            {
                return redirect('/all_personal_expense');
            }
        }
    }
}
