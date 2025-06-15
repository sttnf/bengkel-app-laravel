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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 50)->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->integer('current_stock')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->string('unit', 20);
            $table->string('part_number', 30)->nullable()->unique();
            $table->string('supplier', 100)->nullable();
            $table->string('location', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
