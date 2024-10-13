<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\All_transaction;
use App\Models\Recievable;
use App\Models\Payable;
use App\Models\Personal_expense;

use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function add_transaction()
    {
        $current_date = Carbon::now();
        $current_date = $current_date->toDateTimeString();
        $current_date = Str::substr($current_date, 0, 10);
        $todays_transactions = All_transaction::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();
        $todays_recd = 0;
        $todays_paid = 0;
        foreach ($todays_transactions as $exp) {
            if ($exp->action == 'paid') {
                $todays_paid = $todays_paid + $exp->amount;
            } else {
                $todays_recd = $todays_recd + $exp->amount;
            }
        }
        $data = compact('todays_transactions', 'todays_recd', 'todays_paid');
        return view('add_transaction')->with($data);
    }

    public function save_transaction(Request $request)
    {
        // Server side validations
        $request->validate(
            [
                'name' => 'required',
                'purpose' => 'required',
                'action' => 'required',
                'mode' => 'required',
                'total_amount' => 'required|numeric',
                'inputs' => 'required|array',
                'inputs.*.entity_name' => 'required',
                'inputs.*.amount' => 'required|numeric'
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

        // Create a new transaction
        $transaction = new All_transaction();
        $transaction->name = $request->input('name');
        $transaction->purpose = $request->input('purpose');
        $transaction->action = $request->input('action');
        $transaction->mode = $request->input('mode');
        $transaction->amount = $request->input('total_amount');

        // Save the transaction
        $transaction->save();

        if ($request->action == "paid") {
            // Get the ID of the saved transaction
            $transactionId = $transaction->id;

            // Process the dynamic input fields
            foreach ($request->input('inputs') as $input) {
                $recievable = new Recievable();
                $new_personal_expense = new Personal_expense();

                if ($input['entity_name'] != 'Self') {
                    $recievable->name = $input['entity_name'];
                    $recievable->purpose = $request['purpose'];
                    $recievable->mode = $request['mode'];
                    $recievable->amount = $input['amount'];
                    $recievable->transaction_id = $transactionId;
                    $recievable->save();
                } else if ($input['entity_name'] == 'Self' && $input['amount'] != 0) {
                    $new_personal_expense->name = $request->input('name');
                    $new_personal_expense->purpose = $request->input('purpose');
                    $new_personal_expense->mode = $request->input('mode');
                    $new_personal_expense->amount = $input['amount'];
                    $new_personal_expense->transaction_id = $transactionId;
                    $new_personal_expense->save();
                }
            }
        } else if ($request->action == "received") {
            $transactionId = $transaction->id;
            foreach ($request->input('inputs') as $input) {
                $payable = new Payable();
                $new_personal_expense = new Personal_expense();

                if ($input['entity_name'] != 'Self') {
                    $payable->name = $input['entity_name'];
                    $payable->purpose = $request['purpose'];
                    $payable->mode = $request['mode'];
                    $payable->amount = $input['amount'];
                    $payable->transaction_id = $transactionId;
                    $payable->save();
                }
            }
        }
        return redirect('/add_transaction');
    }

    public function all_transactions()
    {
        $all_transactions = All_transaction::all();
        $data = compact('all_transactions');
        return view('all_transactions')->with($data);
    }

    public function all_received()
    {
        $all_received = All_transaction::where('action', '=', 'received')->get();
        $data = compact('all_received');
        return view('all_received')->with($data);
    }

    public function all_paid()
    {
        $all_paid = All_transaction::where('action', '=', 'paid')->get();
        $data = compact('all_paid');
        return view('all_paid')->with($data);
    }

    public function delete_transaction($id)
    {
        $delete_transaction = All_transaction::find($id);
        if (!is_null($delete_transaction)) {
            // Finding in receivables
            $entry_in_receivable = Recievable::where('transaction_id', '=', $id)->get();
            $entry_in_payable = Payable::where('transaction_id', '=', $id)->get();
            $entry_personal = Personal_expense::where('transaction_id', '=', $id)->get();
            if (!is_null($entry_in_receivable)) {
                foreach ($entry_in_receivable as $entry) {
                    $delete_from_receivable = Recievable::Find($entry->id);
                    if (!is_null($delete_from_receivable)) {
                        $delete_from_receivable->delete();
                    }
                }
            }

            // Finding in payables
            if (!is_null($entry_in_payable)) {
                foreach ($entry_in_payable as $entry) {
                    $delete_from_payable = Payable::Find($entry->id);
                    if (!is_null($delete_from_payable)) {
                        $delete_from_payable->delete();
                    }
                }
            }

            if (!is_null($entry_personal)) {
                foreach ($entry_personal as $entry) {
                    $delete_personal = Personal_expense::Find($entry->id);
                    if (!is_null($delete_personal)) {
                        $delete_personal->delete();
                    }
                }
            }

            if ($delete_transaction->delete()) {
                return redirect('/all_transactions');
            }
        }
    }

    public function update_transaction($id)
    {
        $update_transaction = All_transaction::find($id);
        $current_date = Carbon::now();
        $current_date = $current_date->toDateTimeString();
        $current_date = Str::substr($current_date, 0, 10);
        $todays_transactions = All_transaction::whereBetween('created_at', [$current_date . ' 00:00:00', $current_date . ' 23:59:59'])->get();
        $todays_recd = 0;
        $todays_paid = 0;
        foreach ($todays_transactions as $exp) {
            if ($exp->action == 'paid') {
                $todays_paid = $todays_paid + $exp->amount;
            } else {
                $todays_recd = $todays_recd + $exp->amount;
            }
        }

        $data = compact('update_transaction', 'todays_transactions', 'todays_recd', 'todays_paid');
        return view('/update_transaction')->with($data);
    }

    // Function to filter all transactions by name
    public function search_transaction_name(Request $request)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name.required' => "* Please Enter Name *"
            ]
        );
        $name = $request['name']; // Fetch the name from the form
        $all_transactions = All_transaction::where('name', 'LIKE', "%$name")->get();
        $data = compact('all_transactions', 'name');
        return view('all_transactions')->with($data);
    }

    // Function to filter all transactions by date
    public function search_transaction_date(Request $request)
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
    }

    // Function to filter all received by name
    public function search_received_name(Request $request)
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
        $all_received = All_transaction::where('action', '=', 'received')->where('name', 'LIKE', "%$name")->get();
        $data = compact('all_received', 'name');
        return view('all_received')->with($data);
    }

    // Function to filter all received by date
    public function search_received_date(Request $request)
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
        $from = $request['from_date'];
        $to = $request['to_date'];
        $all_received = All_transaction::where('action', '=', 'received')->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->get();
        $data = compact('all_received', 'from', 'to');
        return view('received_date')->with($data);
    }

    // Function to filter all paid by name
    public function search_paid_name(Request $request)
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
        $all_paid = All_transaction::where('action', '=', 'paid')->where('name', 'LIKE', "%$name")->get();
        $data = compact('all_paid', 'name');
        return view('all_paid')->with($data);
    }

    // Function to filter all paid by name
    public function search_paid_date(Request $request)
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
        $from = $request['from_date'];
        $to = $request['to_date'];
        $all_paid = All_transaction::where('action', '=', 'paid')->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])->get();
        $data = compact('all_paid', 'from', 'to');
        return view('paid_date')->with($data);
    }

    public function save_update_transaction(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'purpose' => 'required',
            ],
            [
                'name.required' => "* Please Enter Name *",
                'purpose.required' => "* Please Enter Purpose *",
            ]
        );
        $update_transaction = All_transaction::Find($request->input('id'));
        if (!is_null($update_transaction)) {
            if ($request->input('action') == 'paid') {
                $update_personal = Personal_expense::where('transaction_id', '=', $update_transaction->id)->get();
                foreach ($update_personal as $personal) {
                    $personal->update([
                        'name' => $request['name'],
                        'purpose' => $request['purpose'],
                        'mode' => $request['mode']
                    ]);
                }

                $update_receivable = Recievable::where('transaction_id', $update_transaction->id)->get();
                foreach ($update_receivable as $receivable) {
                    $receivable->update([
                        'name' => $request['name'],
                        'purpose' => $request['purpose'],
                        'mode' => $request['mode']
                    ]);
                }

                $update_transaction->update([
                    'name' => $request['name'],
                    'purpose' => $request['purpose'],
                    'mode' => $request['mode']
                ]);
            } else {
                $update_payable = Payable::where('transaction_id', $update_transaction->id)->get();
                foreach ($update_payable as $payable) {
                    $payable->update([
                        'name' => $request['name'],
                        'purpose' => $request['purpose'],
                        'mode' => $request['mode']
                    ]);
                }

                $update_transaction->update([
                    'name' => $request['name'],
                    'purpose' => $request['purpose'],
                    'mode' => $request['mode']
                ]);
            }
        }
    }
}
