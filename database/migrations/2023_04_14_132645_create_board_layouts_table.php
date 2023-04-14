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
            $table->tinyInteger('layout_position');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('board_id')->nullable();
            $table->foreignId('parent_layout_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_layouts');
    }
};
