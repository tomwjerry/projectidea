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
            $table->tinyInteger('status_position')->nullable();
            $table->tinyInteger('status_lane')->nullable();
            $table->tinyInteger('prioritization');
            $table->string('color')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('display_points', 6, 2)->nullable();
            $table->dateTime('issue_start')->nullable();
            $table->dateTime('planned_end')->nullable();
            $table->unique(['local_id', 'board_id', 'project_id']);
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
