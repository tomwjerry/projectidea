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
        Schema::create('issue_fields', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id');
            $table->foreignId('issue_type_id');
            $table->foreignId('field_type');
            $table->integer('field_order');
            $table->foreignId('parent_id')->nullable(true);
            $table->string('name');
            $table->string('identification_name');
            $table->string('description')->nullable(true);
            $table->boolean('hidden');
            $table->unique(['identification_name', 'project_id']);
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
