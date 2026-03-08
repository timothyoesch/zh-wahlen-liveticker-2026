<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Truncate the table to remove all existing data
        DB::table('grkandis')->truncate();
        Schema::table('grkandis', function (Blueprint $table) {
            $table->integer('votes')->nullable()->change();
            $table->string("identifier")->after("updated_at")
                ->unique()
                ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grkandis', function (Blueprint $table) {
            $table->integer('votes')->nullable(false)->change();
            $table->dropColumn("identifier");
        });
    }
};
