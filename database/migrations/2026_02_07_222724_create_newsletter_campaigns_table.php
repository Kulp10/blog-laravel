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
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['custom', 'weekly_digest'])->default('custom')->comment('Tipo: custom (comunicazione manuale) o weekly_digest (digest settimanale automatico)');
            $table->foreignId('article_id')->nullable()->constrained()->cascadeOnDelete();
            $table->json('article_ids')->nullable()->comment('Array di ID articoli (per weekly digest)');
            $table->string('subject')->comment('Oggetto email');
            $table->longtext('content')->nullable()->comment('Contenuto EditorJS JSON (per custom)');
            $table->longtext('content_html')->nullable()->comment('HTML renderizzato per email');
            $table->enum('status', ['draft', 'scheduled', 'sent'])->default('draft')->comment('Stato della campagna');
            $table->timestamp('sent_at')->nullable();
            $table->integer('recipients_count')->default(0)->comment('Numero destinatari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_campaigns');
    }
};
