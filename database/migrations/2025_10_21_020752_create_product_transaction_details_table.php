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
        Schema::create('product_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->references("id")->on("products")->onDelete("CASCADE");

            $table->unsignedBigInteger('product_transaction_header_id');
            $table->foreign('product_transaction_header_id', 'fk_detail_header')
            ->references('id')
            ->on('product_transaction_headers')
            ->onDelete('cascade');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transaction_details');
    }
};
