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
        Schema::create('shoe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('shoe_categories')
                ->onDelete('cascade');
            $table->string('brand');
            $table->string('model');
            $table->double('base_price', 10, 2);
            $table->text('description');
            $table->timestamps();

            $table->unique(['category_id', 'brand', 'model']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoe_details');
    }
};
