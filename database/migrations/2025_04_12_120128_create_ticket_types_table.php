<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('visitor_category', ['Ugandan Citizen', 'Foreign Visitor']);
            $table->enum('age_category', ['Adult', 'Child']);
            $table->decimal('price', 10, 2);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
        
        // Insert default ticket types
        DB::table('ticket_types')->insert([
            ['name' => 'Ugandan Adult', 'visitor_category' => 'Ugandan Citizen', 'age_category' => 'Adult', 'price' => 5000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ugandan Child', 'visitor_category' => 'Ugandan Citizen', 'age_category' => 'Child', 'price' => 3000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Foreign Adult', 'visitor_category' => 'Foreign Visitor', 'age_category' => 'Adult', 'price' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Foreign Child', 'visitor_category' => 'Foreign Visitor', 'age_category' => 'Child', 'price' => 10000, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
