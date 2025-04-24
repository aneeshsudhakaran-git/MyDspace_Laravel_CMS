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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category')->nullable();
            $table->integer('menu')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('download_file_title')->nullable();
            $table->string('download_file')->nullable();
            $table->smallInteger('displayorder')->default(1);
            $table->smallInteger('content_section')->default(1);
            $table->char('featured', length: 1)->default(0); // 1 - Featured 0- Not Featured
            $table->tinyInteger('classname')->default(0);
            $table->char('status', length: 1); // P - published U - Unpublished  D- Deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
