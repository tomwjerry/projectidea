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
        Schema::create('board_layouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('local_id');
            $table->tinyInteger('layout_position');
            $table->tinyInteger('lane');
            $table->boolean('defines_lane');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id');
            $table->foreignId('board_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unique(['local_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
