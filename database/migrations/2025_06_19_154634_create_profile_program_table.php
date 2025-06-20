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
        Schema::create('profile_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('program_id')
                ->constrained()
                ->onDelete('cascade');
            $table->date('date_enrolled')->nullable();
            $table->boolean('active')->default(true);
            $table->json('details')->nullable();
            $table->timestamps();
            $table->unique(['profile_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_program');
    }
};
