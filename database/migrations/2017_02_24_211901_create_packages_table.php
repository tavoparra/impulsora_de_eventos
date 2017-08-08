<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('package_price');
            $table->boolean('published')->default(true);
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });

        // Create the many to many relationship table
        Schema::create('package_product', function(Blueprint $table){
            $table->increments('id');
            $table->integer('package_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty')->unsigned();
            
            $table->index('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_product');
        Schema::dropIfExists('packages');
    }
}
