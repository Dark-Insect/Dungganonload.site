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
        Schema::create('sent_mail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id');
            $table->foreignId('user_id');
            $table->boolean('is_seen');
            $table->date('date_received');
            $table->date('date_sent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_sent_');
    }
};
