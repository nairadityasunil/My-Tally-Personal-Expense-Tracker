<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail_master extends Model
{
    use HasFactory;
    protected $table = "mail_master";
    protected $primaryKey = "id";

    protected $fillable =[
        'email',
    ];
}
