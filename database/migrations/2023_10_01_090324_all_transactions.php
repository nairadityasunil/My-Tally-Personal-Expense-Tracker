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
        Schema::create('all_transactions' , function(Blueprint $table)
        {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 120);
            $table->string('purpose',150);
            $table->enum('action',array('paid','received'));
            $table->enum('mode', array('cash','bank transfer','net banking','upi'));
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
