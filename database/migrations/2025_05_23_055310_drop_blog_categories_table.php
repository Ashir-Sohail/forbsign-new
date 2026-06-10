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
        Schema::dropIfExists('blog_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {

            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }
};
