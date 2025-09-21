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
        Schema::create('api_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('method', 10); // GET, POST, PUT, DELETE, etc.
            $table->string('endpoint', 500);
            $table->string('full_url', 1000);
            $table->integer('status_code');
            $table->integer('response_time_ms');
            $table->json('request_headers')->nullable();
            $table->json('request_body')->nullable();
            $table->json('response_headers')->nullable();
            $table->text('response_body')->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('ip_address', 45);
            $table->string('api_version', 20)->default('v1');
            $table->boolean('is_successful')->default(true);
            $table->text('error_message')->nullable();
            $table->timestamp('requested_at');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'requested_at']);
            $table->index(['endpoint', 'requested_at']);
            $table->index(['status_code', 'requested_at']);
            $table->index(['is_successful', 'requested_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_requests');
    }
};
