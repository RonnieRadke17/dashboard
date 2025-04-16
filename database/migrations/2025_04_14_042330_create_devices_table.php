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
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('devicename', 45); // Personalizado por el usuario
        $table->string('device_model', 100); // Modelo estimado o exacto
        $table->boolean('is_active')->default(false);
        $table->string('ip', 45);
        $table->string('latitude', 45)->nullable();
        $table->string('longitude', 45)->nullable();
        $table->char('baterylevel', 3)->nullable();
        $table->string('user_agent', 255); // Info técnica del navegador

        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('types_id');

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
