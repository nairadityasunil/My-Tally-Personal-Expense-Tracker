<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RecievablesController;
use App\Http\Controllers\PayablesController;
use App\Http\Controllers\Personal_expenses;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User_Mail_Controller;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Rotues for user authentication and login page
Route::get('/',[LoginController::class,'login_page'])->name('login_page');
Route::post('/authenticate',[LoginController::class,'authenticate_user'])->name('authenticate');

// Routes related to transaction section
Route::get('/add_transaction', [TransactionController::class , 'add_transaction'])->name('add_transaction');
Route::get('/all_transactions', [TransactionController::class , 'all_transactions'])->name('all_transactions');
Route::get('all_received',[TransactionController::class , 'all_received'])->name('all_received');
Route::get('/all_paid',[TransactionController::class , 'all_paid'])->name('all_paid');
Route::get('/update_transaction/{id}' ,[TransactionController::class , 'update_transaction'])->name('update_transaction');
Route::get('/delete_transaction/{id}' ,[TransactionController::class , 'delete_transaction'])->name('delete_transaction');
Route::post('/save_transaction',[TransactionController::class,'save_transaction'])->name('save_transaction');
Route::post('/save_update_transaction',[TransactionController::class,'save_update_transaction'])->name('save_update_transaction');

// Routes related to account recievables section
Route::get('/all_recievables', [RecievablesController::class,'view_all_recievables'])->name('all_recievables');
Route::get('/new_receivable' ,[RecievablesController::class, 'new_receivable'])->name('new_receivable');
Route::get('/confirm_receivable/{id}' ,[RecievablesController::class, 'confirm_receivable'])->name('confirm_receivable');
Route::post('/save_new_receivable',[RecievablesController::class, 'save_new_receivable'])->name('save_new_receivable');
Route::post('/save_receivable',[RecievablesController::class, 'save_receivable'])->name('save_receivable');
Route::post('/search_receivable',[RecievablesController::class,'search_receivable'])->name('search_receivable');

// Routes related to account payable sections
Route::get('/all_payables', [PayablesController::class,'view_all_payables'])->name('all_payables');
Route::get('/new_payable' ,[PayablesController::class, 'new_payable'])->name('new_payable');
Route::get('/confirm_payable/{id}' ,[PayablesController::class, 'confirm_payable'])->name('confirm_payable');
Route::post('/save_new_payable',[PayablesController::class, 'save_new_payable'])->name('save_new_payable');
Route::post('/save_payable',[PayablesController::class, 'save_payable'])->name('save_payable');

// Routes related to personal expense section
Route::get('/all_personal_expense',[Personal_expenses::class,'view_all_personal_expense'])->name('all_personal_expense');
Route::get('/new_personal_expense' ,[Personal_expenses::class, 'new_personal_expense'])->name('new_personal_expense');
Route::post('/save_personal_expense',[Personal_expenses::class, 'save_personal_expense'])->name('save_personal_expense');

// Routes related to dashboard
Route::get('/home',[HomeController::class,'home'])->name('home');

// Routes Related To reports
Route::post('/get_all_received',[TransactionController::class, 'get_all_received'])->name('get_all_received');

// Routes Related To User And Mail
Route::get('/user_mail_master',[User_Mail_Controller::class,'user_mail_master'])->name('user_mail_master');
Route::get('/user_update/{id}',[User_Mail_Controller::class , 'update_details'])->name('user_update');
Route::post('/save_user_update',[User_Mail_Controller::class,'save_user_update'])->name('save_user_update');


// All Routes Related To searching and filtering data
// Routes to filter all transaction page
Route::post('/search_transaction_name',[TransactionController::class,'search_transaction_name'])->name('search_transaction_name');
Route::post('/search_transaction_date',[TransactionController::class,'search_transaction_date'])->name('search_transaction_date');

// Routes to filter all receipts page
Route::post('/search_received_name',[TransactionController::class,'search_received_name'])->name('search_received_name');
Route::post('/search_received_date',[TransactionController::class,'search_received_date'])->name('search_received_date');

// Routes to filer all payments page
Route::post('/search_paid_name',[TransactionController::class,'search_paid_name'])->name('search_paid_name');
Route::post('/search_paid_date',[TransactionController::class,'search_paid_date'])->name('search_paid_date');

// Routes to filter receivables
Route::post('/search_receivable_name',[RecievablesController::class,'search_receivable_name'])->name('search_receivable_name');
Route::post('/search_receivable_date',[RecievablesController::class,'search_receivable_date'])->name('search_receivable_date');

// Routes to filter payable
Route::post('/search_payable_name',[PayablesController::class,'search_payable_name'])->name('search_payable_name');
Route::post('/search_payable_date',[PayablesController::class,'search_payable_date'])->name('search_payable_date');

// Routes to filer personal expenses
Route::post('/search_personal_name',[Personal_expenses::class,'search_personal_name'])->name('search_personal_name');
Route::post('/search_personal_date',[Personal_expenses::class,'search_personal_date'])->name('search_personal_date');