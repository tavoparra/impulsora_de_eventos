<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyClientsTableAddEmailCommentsAndDeleteAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->dropColumn('rfc');
            $table->dropColumn('address');
            $table->text('email')->after('phone');
            $table->text('comments')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('comments');
            $table->text('rfc')->after('name');
            $table->text('address')->after('rfc');
        });
    }
}
