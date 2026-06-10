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
        Schema::create('custom_images', function (Blueprint $table) {
            $table->id();

            $table->string('name');                  
            $table->string('image_path');            
            $table->decimal('per_character_price', 10, 2)->default(0);
            $table->integer('serial')->default(0);   // for sorting order
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_images');
    }
};
