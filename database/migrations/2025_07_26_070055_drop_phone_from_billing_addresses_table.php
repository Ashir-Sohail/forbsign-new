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
        Schema::table('billing_addresses', function (Blueprint $table) {
            $table->dropColumn('phone'); // Drop the phone column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billing_addresses', function (Blueprint $table) {
            $table->string('phone')->nullable(); // Add it back if rolled back

        });
    }
};
