<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('telegram_id')->nullable();
            $table->unsignedBigInteger('telegram_chat_id')->nullable();
            $table->foreign('telegram_chat_id')
                ->references('id')
                ->on('telegraph_chats')
                ->onDelete('set null');
            $table->string('phone')->nullable();
            $table->json('addresses')->nullable();
            $table->enum('payment_methods', ['card', 'cash'])->default('cash');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
  public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['telegram_id']);
            $table->dropColumn('telegram_id');
            $table->dropColumn('phone');
            $table->dropColumn('addresses');
            $table->dropColumn('payment_methods');
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
    }
};

