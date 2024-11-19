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
        Schema::create('appointment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Establecer la relación con la tabla de citas
            $table->foreign('appointment_id')->references('id')->on('scheduled_appointments')->onDelete('cascade');
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_history', function (Blueprint $table) {
            //
        });
    }
};
