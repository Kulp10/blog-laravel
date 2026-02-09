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
        Schema::create('email_bounces', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('message_id')->nullable()->comment('ID messaggio AWS SES');
            $table->enum('bounce_type', ['Permanent', 'Transient', 'Undetermined'])->default('undetermined')->comment('Tipo bounce: Permanent (permanente), Transient (temporaneo), Undetermined (non determinato)');
            $table->enum('bounce_subtype', ['General', 'NoEmail', 'Suppressed', 'OnAccountSuppressionList', 'MailboxFull', 'MessageTooLarge', 'ContentRejected', 'AttachmentRejected'])
                ->nullable()->comment('Sottotipo bounce AWS SES');
            $table->text('diagnostic_code')->nullable()->comment('Codice diagnostico del bounce');
            $table->json('raw_message')->nullable()->comment('Messaggio SNS originale completo');
            $table->timestamp('bounced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_bounces');
    }
};
