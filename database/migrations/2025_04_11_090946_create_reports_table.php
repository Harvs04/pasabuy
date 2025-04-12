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
        if (!Schema::hasTable('reports')) {
            Schema::create('reports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('sender_id');
                $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');     
                $table->uuid('reported_id');
                $table->foreign('reported_id')->references('id')->on('users')->onDelete('cascade');
                $table->uuid('post_id');
                $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
                $table->uuid('order_id')->nullable();
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');                
                $table->enum('type', ['Spam', 'Selling illegal items', 'Bullying, harassment, or abuse', 'Scam or false information', 'Fake identity', 'Others']);
                $table->longText('complaint');
                $table->enum('status', ['Pending', 'Resolved'])->default('Pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
