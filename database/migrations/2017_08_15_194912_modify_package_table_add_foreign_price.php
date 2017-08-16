<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPackageTableAddForeignPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->float('foreign_package_price')->after('package_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('packages', 'foreign_package_price')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('foreign_package_price');
            });
        }
    }
}
