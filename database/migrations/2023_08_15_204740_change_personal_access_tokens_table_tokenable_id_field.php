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
        if (Schema::hasColumn('personal_access_tokens', 'tokenable_id')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropColumn('tokenable_id');
            });

            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->uuid('tokenable_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('personal_access_tokens', 'tokenable_id')) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropColumn('tokenable_id');
            });
        }
    }
};
