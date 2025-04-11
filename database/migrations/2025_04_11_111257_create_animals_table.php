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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->string('profile_photo')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'unknown']);
            $table->foreignId('location_id')->constrained()->onDelete('restrict');
            $table->date('date_of_birth')->nullable();
            $table->date('acquisition_date');
            $table->string('identification_number')->unique()->nullable();
            $table->string('origin')->nullable();
            $table->text('dietary_requirements')->nullable();
            $table->text('medical_history')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes(); // For animals that die or are transferred
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
