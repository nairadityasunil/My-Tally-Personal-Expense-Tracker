<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recievable;
use App\Models\All_transaction;

class RecievablesController extends Controller
{
    public function view_all_recievables()
    {
        $all_recievables = Recievable::all();
        $data = compact('all_recievables');
        return view('all_recievables')->with($data);
    }

    public function confirm_receivable($id)
    {
        $entry_id = Recievable::find($id);
        $all_receivables = Recievable::all();
        if (!is_null($entry_id)) {
            $data = compact('entry_id', 'all_receivables');
            return view('confirm_recievable')->with($data);
        }
    }

    public function save_receivable(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'purpose' => 'required',
                'action' => 'required',
                'mode' => 'required',
                'total_amount' => 'required|numeric'
            ],
            [
                'name.required' => "* Please Enter Name *",
                'purpose.required' => "* Please Enter Purpose *",
                'action.required' => "* Please Select Action *",
                'mode.required' => "* Please Select Mode of Transaction *",
                'total_amount.required' => "* Please Enter Total Amount *",
                'total_amount.numeric' => '* Only Numeric Values Allowed *'
            ]
        );
        $transaction = new All_transaction();
        $transaction->name = $request->input('name');
        $transaction->purpose = $request->input('purpose');
        $transaction->action = $request->input('action');
        $transaction->mode = $request->input('mode');
        $transaction->amount = $request->input('total_amount');

        // Save the transaction
        if ($transaction->save()) {
            $receivable_id = Recievable::find($request->input('receivable_id'));
            if (!is_null($receivable_id)) {
                $receivable_id->delete();
            }
            return redirect('/all_recievables');
        }
    }

    public function delete_receivable($id)
    {
        $entry_id = Recievable::find($id);
        if (!is_null($entry_id)) {
            $entry_id->delete();
        }
        return redirect('/all_recievables');
    }

    public function new_receivable()
    {
        $all_receivables = Recievable::all();
        $data = compact('all_receivables');
        return view('new_receivable')->with($data);
    }

    public function save_new_receivable(Request $request)
    {
        // Server side validations
        $request->validate(
            [
                'name' => 'required',
                'purpose' => 'required',
                'mode' => 'required',
                'total_amount' => 'required|numeric',
            ],
            [
                'name.required' => "* Please Enter Name *",
                'purpose.required' => "* Please Enter Purpose *",
                'mode.required' => "* Please Select Mode of Transaction *",
                'total_amount.required' => "* Please Enter Total Amount *",
                'total_amount.numeric' => '* Only Numeric Values Allowed *'
            ]
        );
        $new_receivable = new Recievable();
        $transaction = new All_transaction();

        $transaction->name = $request->input('name');
        $transaction->purpose = $request->input('purpose');
        $transaction->action = "paid";
        $transaction->mode = $request->input('mode');
        $transaction->amount = $request->input('total_amount');

        if ($transaction->save()) {
            $last_transaction = All_transaction::all()->last();
            $new_receivable->name = $last_transaction->name;
            $new_receivable->purpose = $last_transaction->purpose;
            $new_receivable->mode = $last_transaction->mode;
            $new_receivable->amount = $last_transaction->amount;
            $new_receivable->transaction_id = $last_transaction->id;

            if ($new_receivable->save()) {
                return redirect('/all_recievables');
            }
        }
    }


    public function search_receivable_name(Request $request)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name.required' => "* Please Enter Name *"
            ]
        );
        $name = $request['name'];
        $all_recievables = Recievable::where('name', 'LIKE', "%$name%")->get();
        $data = compact('all_recievables', 'name');
        return view('all_recievables')->with($data);
    }


    public function search_receivable_date(Request $request)
    {
        $request->validate(
            [
                'from_date' => 'required',
                'to_date' => 'required'
            ],
            [
                'from_date' => '* Please Select Date From *',
                'to_date' => '* Please Select Date To *'
            ]
        );
        $from = $request->from_date;
        $to = $request->to_date;
        $all_transactions = All_transaction::whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->get(); // Retrieve all records between a particular date range
        $data = compact('all_transactions', 'from', 'to');
        return view('transaction_date')->with($data);
        $from = $request['from_date'];
        $to = $request['to_date'];
        $all_recievables = All_transaction::whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->get();
        $data = compact('all_recievables', 'from', 'to');
        return view('receivable_date');
    }
}
