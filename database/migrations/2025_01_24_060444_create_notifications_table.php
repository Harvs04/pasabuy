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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['like' ,'comment', 'new order', 'new item request', 'new transaction', 'cancelled order', 'converted post', 'item bought', 'item waiting', 'item confirmed', 'item delivered', 'item rated', 'item unavailable', 'transaction started', 'transaction cancelled']);
            $table->uuid('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->json('order_id')->nullable();
            $table->uuid('actor_id');
            $table->foreign('actor_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('poster_id');
            $table->foreign('poster_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('isSeen')->default(false);
            $table->integer('order_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
