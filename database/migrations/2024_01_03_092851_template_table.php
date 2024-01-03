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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('operating_system')->required();
            $table->string('operating_system_version')->nullable();
            $table->string('language')->required();
            $table->string('language_version')->required();
            $table->string('framework')->required();
            $table->string('framework_version')->required();
            $table->string('database')->required();
            $table->string('database_version')->required();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
