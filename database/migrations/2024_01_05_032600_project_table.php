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
            $table->string('url')->required()->unique();
            $table->ipAddress('ip')->required();
            $table->ipAddress('secondary_ip')->nullable();

            $table->unsignedBigInteger('operating_system')->nullable();
            $table->foreign('operating_system')->references('id')->on('operating_systems')->onDelete('restrict');
            $table->float('operating_system_version')->nullable();
        
            $table->unsignedBigInteger('language')->nullable(); // Change 'required' to 'nullable' if you want it to be optional
            $table->foreign('language')->references('id')->on('languages')->onDelete('restrict');
            $table->float('language_version')->nullable();
        
            $table->unsignedBigInteger('framework')->nullable(); // Change 'required' to 'nullable' if you want it to be optional
            $table->foreign('framework')->references('id')->on('frameworks')->onDelete('restrict');
            $table->float('framework_version')->nullable();
        
            $table->unsignedBigInteger('database')->nullable(); // Change 'required' to 'nullable' if you want it to be optional
            $table->foreign('database')->references('id')->on('database_lists')->onDelete('restrict');
            $table->float('database_version')->nullable();

            $table->string('file')->nullable();
            $table->enum('is_exposed_to_content', ['YES', 'NO'])->required();
            $table->enum('is_dr', ['YES', 'NO'])->required();
            $table->enum('is_vapt_done', ['YES', 'NO'])->required();
            $table->enum('is_backup', ['YES', 'NO'])->required();
            $table->softDeletes();
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
