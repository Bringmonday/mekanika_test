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
        Schema::create('part_produksi', function (Blueprint $table) {
            $table->id();
            $table->string('part_name');
            $table->string('part_code');
            $table->string('part_number');
            $table->string('image_filename');
            $table->string('image_blob');
            $table->integer('qty_in_cart');
            $table->timestamps();
            $table->integer('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_produksi');
    }
};
