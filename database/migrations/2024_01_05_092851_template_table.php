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
            $table->unsignedBigInteger('operating_system')->required();
            $table->string('operating_system_version')->nullable();
            $table->unsignedBigInteger('language')->required();
            $table->string('language_version')->required();
            $table->unsignedBigInteger('framework')->required();
            $table->string('framework_version')->required();
            $table->unsignedBigInteger('database')->required();
            $table->string('database_version')->required();
            $table->foreign('operating_system')->references('id')->on('operating_systems')->onDelete('restrict');
            $table->foreign('language')->references('id')->on('languages')->onDelete('restrict');
            $table->foreign('framework')->references('id')->on('frameworks')->onDelete('restrict');
            $table->foreign('database')->references('id')->on('database_lists')->onDelete('restrict');
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
