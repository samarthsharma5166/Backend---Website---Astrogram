<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admin') && !Schema::hasColumn('admin', 'reset_key')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->string('reset_key', 255)->nullable()->after('password');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('admin') && Schema::hasColumn('admin', 'reset_key')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->dropColumn('reset_key');
            });
        }
    }
};
