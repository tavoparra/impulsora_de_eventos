<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfcs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->text('rfc', 14);
            $table->text('name');
            $table->text('address');
            $table->text('phone');
            $table->text('email', 100);

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rfcs');
    }
}
