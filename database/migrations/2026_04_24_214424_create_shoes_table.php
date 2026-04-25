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
        Schema::create('shoes', function (Blueprint $table) {
            $table->unsignedBigInteger('sku')->primary();
            $table->foreignId('shoe_detail_id')
                ->constrained('shoe_details')
                ->onDelete('cascade');
            $table->foreignId('shoe_color_id')
                ->constrained('shoe_colors')
                ->onDelete('cascade');
            $table->foreignId('shoe_size_id')
                ->constrained('shoe_sizes')
                ->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->boolean('is_discontinued')->default(false);
            $table->boolean('is_promotion')->default(false);
            $table->decimal('price', 8, 2);
            $table->decimal('promo_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoes');
    }
};
