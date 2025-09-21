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
        Schema::create('api_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('total_requests')->default(0);
            $table->integer('successful_requests')->default(0);
            $table->integer('failed_requests')->default(0);
            $table->decimal('average_response_time', 8, 2)->default(0);
            $table->integer('max_response_time')->default(0);
            $table->integer('min_response_time')->default(0);
            $table->json('status_code_breakdown')->nullable(); // {200: 100, 404: 5, 500: 2}
            $table->json('endpoint_usage')->nullable(); // {'/api/companies': 50, '/api/deals': 30}
            $table->decimal('uptime_percentage', 5, 2)->default(100.00);
            $table->integer('unique_users')->default(0);
            $table->json('hourly_distribution')->nullable(); // [0: 10, 1: 5, 2: 8, ...]
            $table->timestamps();
            
            $table->unique('date');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_metrics');
    }
};
