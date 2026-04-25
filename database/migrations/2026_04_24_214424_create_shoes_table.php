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
            $table->id();
            $table->string('sku', 255);
            $table->foreignId('shoe_detail_id')
                ->constrained('shoe_details')
                ->onDelete('cascade');
            $table->string('color', 255);
            $table->double('size', 5, 2);
            $table->integer('stock')->default(0);
            $table->boolean('is_discontinued')->default(false);
            $table->boolean('is_promotion')->default(false);
            $table->decimal('promo_price', 8, 2)->nullable();
            $table->timestamps();

            $table->unique(['shoe_detail_id', 'color', 'size']);
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
