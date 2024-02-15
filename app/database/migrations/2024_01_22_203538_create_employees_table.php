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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('lastname');
            $table->string('url_photo')->nullable();
            $table->json('data')->nullable(); // Campo JSON
            $table->string('position')->nullable();  // Agregar el campo 'position'
            $table->string('email')->unique()->nullable(); // Agregar el campo 'email'
            $table->string('status')->default('active');
            $table->foreignId('id_company')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignId('id_schedule')->nullable()->constrained('schedules')->onDelete('set null');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_role')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
