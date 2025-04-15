<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->integer('adult_tickets');
            $table->integer('child_tickets');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['Cash', 'Mobile Money', 'Credit Card', 'Bank Transfer']);
            $table->text('special_requests')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};