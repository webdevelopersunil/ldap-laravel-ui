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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('user_id')->required();
            $table->string('file')->nullable();
            $table->string('url')->required()->unique();
            $table->ipAddress('ip')->nullable();
            $table->ipAddress('secondary_ip')->nullable();
            $table->string('operating_system')->required();
            $table->string('operating_system_version')->nullable();
            $table->string('language')->required();
            $table->string('language_version')->required();
            $table->string('framework')->required();
            $table->string('framework_version')->required();
            $table->string('database')->required();
            $table->string('database_version')->required();
            $table->enum('is_exposed_to_content', ['YES', 'NO'])->required();
            $table->enum('is_dr', ['YES', 'NO'])->required();
            $table->enum('is_vapt_done', ['YES', 'NO'])->required();
            $table->enum('is_backup', ['YES', 'NO'])->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
