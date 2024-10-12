<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_master' , function(Blueprint $table)
        {
            $table->bigInteger('id')->autoIncrement();
            $table->string('username', 120);
            $table->string('password', 255);
            $table->string('email', 120);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Instructions to be executed if the table is already present in the database
        
    }
};
