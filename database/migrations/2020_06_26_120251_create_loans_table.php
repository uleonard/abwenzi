<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('client');
            $table->integer('loan_type');
            $table->double('amount');
            $table->string('source_of_funds');
            $table->date('date_applied');
            $table->integer('processed_by');
            $table->integer('processed_by');
            $table->date('date_processed');
            $table->date('date_authorized');
            $table->date('due_date');
            $table->double('interest');
            $table->double('balance');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
