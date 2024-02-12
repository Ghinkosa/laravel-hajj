<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hajiras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hajiras', function (Blueprint $table) {
        $table->id();
        $table->string('payment_code');
        $table->string('paid');
        $table->string('bank_code');
        $table->string('account_number');
        $table->string('account_holder');
        $table->string('refrence_number');
        $table->string('amount');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
