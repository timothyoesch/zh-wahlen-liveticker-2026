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
        Schema::create('partyresults', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('party');
            $table->integer('votes');
            $table->decimal('electors', 8, 4);
            $table->decimal('percentage', 8, 4);
            $table->decimal('change', 8, 4);
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partyresults');
    }
};
