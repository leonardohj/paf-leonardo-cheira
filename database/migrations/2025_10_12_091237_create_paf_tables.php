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
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('nome', 100);
            $table->string('code', 50);
            $table->boolean('status')->default(false);
            $table->string('location')->nullable();
            $table->string('pet_type')->nullable();
            $table->timestamp('last_fed_at')->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_feeder');
            $table->time('hour')->default('00:00:00');
            $table->integer('quantity')->default(0);
            $table->string('type');
            $table->json('days')->nullable();
            $table->timestamps();
            $table->foreign('id_feeder')->references('id')->on('feeder')->onDelete('cascade');
        });

        Schema::create('feeding_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_feeder');
            $table->date('date');
            $table->time('hour')->default('00:00:00');
            $table->integer('quantity');
            $table->string('status')->default('success');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('id_feeder')->references('id')->on('feeder')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('feeding_log');
        Schema::dropIfExists('schedule');    
        Schema::dropIfExists('feeder');      
    }    
};

