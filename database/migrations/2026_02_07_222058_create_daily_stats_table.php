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
        Schema::create('daily_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->integer('view_count')->default(0)->comment('Numero totale di visite');
            $table->integer('unique_visitors')->default(0)->comment('Numero di visitatori unici');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_stats');
    }
};
