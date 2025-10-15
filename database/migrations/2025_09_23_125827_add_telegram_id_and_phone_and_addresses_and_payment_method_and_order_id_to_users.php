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
            $table->unsignedBigInteger('telegram_id')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->json('addresses')->nullable()->after('phone');
            $table->enum('payment_methods', ['card','cash'])->default('cash')->after('addresses');
            $table->enum('state', ['waiting_phone','waiting_address','waiting_order','waiting_name'])->nullable()->after('addresses');
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
            $table->dropColumn('telegram_id');
            $table->dropColumn('phone');
            $table->dropColumn('addresses');
            $table->dropColumn('payment_methods');
            $table->dropColumn('state');
        });
    }
};

