<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->unsignedBigInteger('customer_id'); // Changed to unsignedBigInteger
            $table->date('date');
            $table->date('due_date');
            $table->string('reference')->nullable();
            $table->text('term_and_conditions');
            $table->double('discount')->default(0);
            $table->double('sub_total');
            $table->double('total');
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
