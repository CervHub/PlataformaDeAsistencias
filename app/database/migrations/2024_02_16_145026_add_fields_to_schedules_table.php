<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('totalHours')->nullable();
            $table->string('lunchHours')->nullable();
            $table->string('workHours')->nullable();
            $table->string('horas_receso')->nullable();
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('totalHours');
            $table->dropColumn('lunchHours');
            $table->dropColumn('workHours');
            $table->dropColumn('horas_receso');
        });
    }
};
