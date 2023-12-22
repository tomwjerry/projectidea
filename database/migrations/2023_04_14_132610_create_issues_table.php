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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('local_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id');
            $table->foreignId('board_id');
            $table->boolean('is_epic');
            $table->foreignId('epic_id')->nullable();
            $table->tinyInteger('prioritization');
            $table->tinyInteger('progress');
            $table->string('color')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('estimation_min', 6, 2)->nullable();
            $table->decimal('estimation_max', 6, 2)->nullable();
            $table->decimal('actual_points', 6, 2)->nullable();
            $table->decimal('current_work', 6, 2)->nullable();
            $table->dateTime('planned_start')->nullable();
            $table->dateTime('actual_start')->nullable();
            $table->dateTime('planned_final')->nullable();
            $table->dateTime('actual_final')->nullable();
            $table->text('retrospective')->nullable();
            $table->unique(['local_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
