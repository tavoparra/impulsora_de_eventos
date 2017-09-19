<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table){
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->text("address_name", 50);
            $table->text("address");
            $table->text("street");
            $table->text("number");
            $table->text("colony");
            $table->text("city");
            $table->text("state");
            $table->text("zip");
            $table->float("lat");
            $table->float("long");
            $table->enum("address_type", ['client', 'public', 'regular']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("addresses");
    }
}
