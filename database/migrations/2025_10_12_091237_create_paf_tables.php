<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feeder', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_user');
            $table->string('nome');
            $table->string('status');
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_feeder');
            $table->time('time')->default('00:00');
        });

        Schema::create('fodder', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_feeder');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

