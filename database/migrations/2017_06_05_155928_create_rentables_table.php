<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentables', function(Blueprint $table){
            $table->integer('reservation_id')->unsigned();
            $table->integer('rentable_id')->unsigned();
            $table->integer('rented_qty')->unsigned();
            $table->string('rentable_type', 64);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentables');
    }
}
