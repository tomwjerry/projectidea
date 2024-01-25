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
        Schema::create('issue_data', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id');
            $table->foreignId('board_id');
            $table->foreignId('issue_type_id')->nullable(true);
            $table->foreignId('issue_field_id')->nullable(true);
            $table->foreignId('issue_id');
            $table->boolean('hidden');
            $table->boolean('is_meta');
            $table->integer('revision_nr')->nullable(true);
            $table->foreignId('for_revision')->nullable(true);
            $table->datetime('autosave_at')->nullable(true);
            $table->string('meta_name')->nullable(true);
            $table->string('index_value')->nullable(true);
            $table->text('meta_data')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_board');
    }
};
