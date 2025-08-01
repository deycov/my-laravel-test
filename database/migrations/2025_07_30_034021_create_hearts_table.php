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
        Schema::create('hearts', function (Blueprint $table) {
            $table->id();

            $table->boolean('confirmed')->nullable()->default(false);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->morphs('heartable'); // references to coments, answers, questions and publications

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hearts');
    }
};
