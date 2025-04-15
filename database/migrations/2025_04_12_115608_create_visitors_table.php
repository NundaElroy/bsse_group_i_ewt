<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->enum('visitor_type', ['Ugandan Citizen', 'Foreign Visitor']);
            $table->enum('document_type', ['National ID', 'Passport', 'Other'])->nullable();
            $table->string('document_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
