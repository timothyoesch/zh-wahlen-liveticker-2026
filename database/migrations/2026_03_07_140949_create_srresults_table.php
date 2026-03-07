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
        Schema::create('srresults', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("votes")->nullable();
            $table->foreignId("srkandi_id")->constrained("srkandis")->onDelete("cascade");
            $table->foreignId("district_id")->constrained("districts")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('srresults');
    }
};
