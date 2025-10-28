<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->default(null)->after('email');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->enum('status', ['new','published'])->default('new')->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
