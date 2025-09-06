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
        Schema::create('donate_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("donate_id")->unsigned();
            $table->bigInteger("total_donate");

            $table->foreign("user_id")->references("id")->on("users")->onDelete("CASCADE");
            $table->foreign("donate_id")->references("id")->on("donates")->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donate_transactions');
    }
};
