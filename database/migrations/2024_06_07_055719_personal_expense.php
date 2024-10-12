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
        Schema::create('personal_expense' , function(Blueprint $table)
        {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 120);
            $table->string('purpose',150);
            $table->enum('mode', array('cash','bank transfer','net banking','upi'));
            $table->decimal('amount', 10, 2);
            $table->bigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('all_transactions')->onDelete('cascade')->onUpdate('cascade');
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
