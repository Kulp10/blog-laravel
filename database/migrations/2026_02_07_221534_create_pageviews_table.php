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
        Schema::create('pageviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->ondelete('cascade');
            $table->string('path');
            $table->string('session_id')->comment('Identificatore sessione utente');
            $table->string('referer')->nullable();
            $table->string('device_type')->nullable()->comment('Tipo dispositivo: mobile, desktop, tablet');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
