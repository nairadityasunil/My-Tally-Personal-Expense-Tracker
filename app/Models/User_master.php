<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_master extends Model
{
    use HasFactory;
    protected $table = "user_master";
    protected $primaryKey = "id";

    protected $fillable = [
        'username',
        'password',
        'email',
    ];
}
