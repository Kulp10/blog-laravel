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
        Schema::create('email_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('message_id')->nullable()->comment('ID messaggio AWS SES');
            $table->enum('complaint_feedback_type', ['abuse', 'auth-failure', 'fraud', 'not-spam', 'other', 'virus'])->nullable()->comment('Tipo di complaint/segnalazione spam');
            $table->string('user_agent');
            $table->json('raw_message')->nullable()->comment('Messaggio SNS originale completo');
            $table->timestamp('complained_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_complaints');
    }
};
