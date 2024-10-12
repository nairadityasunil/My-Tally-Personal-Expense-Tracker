<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    use HasFactory;
    protected $table = "payables";
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'purpose',
        'mode',
        'transaction_id',
        // Add any other attributes that you want to be mass assignable
    ];
}
