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
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->nullable()->constrained('service_requests')->onDelete('cascade');
            $table->integer('rating')->nullable()->check('rating >= 1 AND rating <= 5');
            $table->text('review_text')->nullable();
            $table->timestamp('review_date')->nullable();
            $table->timestamps();
            
            $table->index('request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_reviews');
    }
};
