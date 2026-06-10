<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Adding new fields
            $table->string('selectedFont')->nullable();
            $table->string('selectedSize')->nullable();
            $table->decimal('overallWidth', 8, 2)->nullable();
            $table->string('selectedSignLayout')->nullable();
            $table->string('homeNumber')->nullable();
            $table->string('streetName')->nullable();
            $table->string('text')->nullable();
            $table->string('textStyle')->nullable();
            $table->string('top')->nullable();
            $table->string('bottom')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Dropping the new fields
            $table->dropColumn([
                'selectedFont',
                'selectedSize',
                'overallWidth',
                'selectedSignLayout',
                'homeNumber',
                'streetName',
                'text',
                'textStyle',
                'top',
                'bottom',
            ]);
        });
    }
};
