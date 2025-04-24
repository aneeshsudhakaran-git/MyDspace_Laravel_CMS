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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->tinyInteger('classname')->default(0);
            $table->integer('parent_id')->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('menutype')->default(1); //default menu , main menu, footer menu
            $table->smallInteger('displayorder')->default(1);
            $table->char('status', length: 1); // P - published U - Unpublished  D- Deleted
            $table->char('link_type', length: 1)->default('S'); // S - Self, N- new page, T- new Tab
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
