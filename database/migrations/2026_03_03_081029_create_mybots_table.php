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
        Schema::create('mybots', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('language_code', 10)->nullable();
            $table->boolean('is_bot')->default(true);
            $table->boolean('can_join_groups')->default(false);
            $table->boolean('can_read_all_group_messages')->default(false);
            $table->boolean('supports_inline_queries')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mybots');
    }
};
