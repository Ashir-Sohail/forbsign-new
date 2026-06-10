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
        Schema::create('custom_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "24 inches", "Large", etc.
            $table->decimal('extra_price', 10, 2)->default(0); // price added for this size
            $table->integer('serial')->default(0); // for sorting
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_sizes');
    }
};
