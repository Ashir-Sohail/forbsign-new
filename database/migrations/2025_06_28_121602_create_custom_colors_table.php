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
        Schema::create('custom_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // e.g. "Red", "Sky Blue"
            $table->string('hex_code');       // e.g. "#ff0000"
            $table->decimal('price', 10, 2)->nullable();    // Optional price, nullable
            $table->integer('serial')->default(0);  // for sorting
            $table->boolean('status')->default(1);  // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_colors');
    }
};
