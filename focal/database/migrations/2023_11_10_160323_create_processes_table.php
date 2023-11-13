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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('wallets')->cascadeOnDelete();
            $table->string('contact_number');
            $table->string('amount');
            $table->string('sender_name');
            $table->string('sender_id_number');
            $table->enum('payment_method',['Withdraw','Deposit']);
            $table->string('receipt_number');
            $table->string('address');
            $table->string('receiver_name');
            $table->string('receiver_id_number');
            $table->integer('password_vorifi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
