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
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign keys for sub_cat_id and child_cat_id (if they exist)
            $table->dropForeign(['sub_cat_id']);
            $table->dropForeign(['child_cat_id']);

            // Drop sub_cat_id and child_cat_id columns
            $table->dropColumn(['sub_cat_id', 'child_cat_id']);

            // Drop existing foreign keys for cat_id and brand_id
            $table->dropForeign(['cat_id']);
            $table->dropForeign(['brand_id']);

            // Make cat_id and brand_id nullable
            $table->unsignedBigInteger('cat_id')->nullable()->change();
            $table->unsignedBigInteger('brand_id')->nullable()->change();
        });

        // Re-add foreign keys with nullOnDelete
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('cat_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop updated foreign keys
            $table->dropForeign(['cat_id']);
            $table->dropForeign(['brand_id']);

            // Revert cat_id and brand_id to NOT NULL
            $table->unsignedBigInteger('cat_id')->nullable(false)->change();
            $table->unsignedBigInteger('brand_id')->nullable(false)->change();

            // Re-add sub_cat_id and child_cat_id
            $table->foreignId('sub_cat_id')->nullable()->constrained('sub_categories')->cascadeOnDelete();
            $table->foreignId('child_cat_id')->nullable()->constrained('child_categories')->cascadeOnDelete();

            // Re-add original foreign keys for cat_id and brand_id with cascade
            $table->foreign('cat_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        });
    }
};
