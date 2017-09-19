<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyReservationsTableAddClientIdAndDiscountAndStatusNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropColumn('customer');
            $table->dropColumn('date');
            $table->dropColumn('total');
            $table->dateTime('date_event')->after('id');
            $table->dateTime('date_delivery')->after('date_event');
            $table->dateTime('date_pickup')->after('date_delivery');
            $table->float('discount')->after('updated_at')->default(0);
            $table->enum('discount_type', ['Porcentaje','Cantidad'])->after('discount');
            $table->enum('status', ['Pendiente','Confirmada', 'Cancelada'])->after('discount_type');
            $table->text('notes')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('reservations', 'notes')) {
            Schema::table('reservations', function (Blueprint $table) {
                $table->text('customer')->after('id');
                $table->date('date')->after('customer');
                $table->float('total')->after('location');
                $table->dropColumn('date_event');
                $table->dropColumn('date_delivery');
                $table->dropColumn('date_pickup');
                $table->dropColumn('discount');
                $table->dropColumn('discount_type');
                $table->dropColumn('status');
                $table->dropColumn('notes');
            });
        }
    }
}
