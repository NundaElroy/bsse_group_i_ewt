<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) 
        {
            $table->id();
            $table->string('email')->unique();
            $table->string('subject',255);
            $table->text('comment');
            $table->integer('rating')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
//     Schema::table('feedback', function (Blueprint $table) {
//         $table->date('date')->nullable(false)->change(); // Revert to non-nullable
//     });
// }
};
