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
        Schema::create('project_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('project_id');
            $table->foreignId('member_id');
            $table->foreignId('story_id')->nullable();
            $table->string('action');
            $table->foreignId('miscellany_id')->nullable();
            $table->text('log_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_logs');
    }
};
