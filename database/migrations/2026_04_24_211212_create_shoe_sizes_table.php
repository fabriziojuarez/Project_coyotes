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
        Schema::create('shoe_sizes', function (Blueprint $table) {
            $table->id();
            $table->double('us_size', 4, 2);
            $table->double('eur_size', 4, 2);
            $table->double('uk_size', 4, 2);
            $table->double('cm_size', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoe_sizes');
    }
};
