<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equities', function (Blueprint $table) {
            $table->id();
            $table->integer('shareholder');
            $table->date('trans_date');
            $table->string('entry')->nullable();
            $table->double('amount');
            $table->string('comment')->nullable();
            $table->integer('entered_by');
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
        Schema::dropIfExists('equities');
    }
}
