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
        Schema::create('grkandis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("number");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("party");
            $table->boolean("incumbent");
            $table->integer("votes")->nullable();
            $table->integer("ranking")->nullable();
            $table->foreignId("district_id")->constrained("districts")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grkandis');
    }
};
