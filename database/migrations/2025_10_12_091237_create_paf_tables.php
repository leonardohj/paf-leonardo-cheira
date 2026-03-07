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
            $table->integer('id_user')->nullable(true);
            $table->string('name')->nullable(true);
            $table->boolean('status')->default(false);
            $table->string('code');
            $table->string('pet_type')->nullable(true);
            $table->date('last_fed_at')->nullable(true);
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_feeder');
            $table->time('time');
             $table->integer('quantity');
             $table->string('type');
             $table->json('days')->nullable(true);
        });

        Schema::create('feeding_log', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_feeder');
            $table->integer('quantity');
            $table->integer('status');
            $table->string('notes')->nullable(true);
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeding_log');
        Schema::dropIfExists('feeder');
        Schema::dropIfExists('schedule');
    }
};

