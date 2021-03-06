<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('firstname');
            $table->string('gender');
            $table->date('dob');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('physical_address');
            $table->string('phone');
            $table->string('phone_other')->nullable();
            $table->string('email')->nullable();
            $table->integer('entered_by');
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE clients AUTO_INCREMENT = 10001;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
