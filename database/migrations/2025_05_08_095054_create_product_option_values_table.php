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
        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('option_value_id')->constrained()->onDelete('cascade');
            $table->boolean('required')->default(0);
            $table->integer('quantity')->default(0);
            $table->boolean('subtract')->default(1);
            $table->char('price_prefix', 1)->default('+');
            $table->decimal('price', 10, 2)->default(0);
            $table->char('points_prefix', 1)->default('+');
            $table->integer('points')->default(0);
            $table->char('weight_prefix', 1)->default('+');
            $table->decimal('weight', 8, 2)->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_values');
    }
};
