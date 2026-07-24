<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('websitetemplates');
        Schema::dropIfExists('websites');
    }

    public function down(): void
    {
        // Tables were removed as part of retiring the incomplete multi-tenant website feature.
    }
};
