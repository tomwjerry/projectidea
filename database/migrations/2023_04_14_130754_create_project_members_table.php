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
        Schema::create('project_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('local_id');
            $table->timestamps();
            $table->foreignId('user_id')->nullable(true);
            $table->foreignId('project_id');
            $table->foreignId('role_id');
            $table->foreignId('organization_id');
            $table->string('invitation_token')->nullable(true);
            $table->string('invitation_email')->nullable(true);
            $table->boolean('is_invitation');
            $table->boolean('is_public_anon');
            $table->boolean('is_public_loggedin');

            $table->unique(['user_id', 'project_id']);
            $table->unique(['local_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};
