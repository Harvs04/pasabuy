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
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->enum('type', ['item_request', 'transaction']);
                $table->enum('status', ['open', 'full', 'converted', 'ongoing', 'closed', 'cancelled'])->default('open');
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('poster_name');
                $table->string('item_name');
                $table->string('item_origin');
                $table->json('item_type');
                $table->json('sub_type')->nullable();
                $table->string('item_image');
                $table->date('delivery_date');
                $table->time('arrival_time')->nullable();
                $table->json('mode_of_payment');
                $table->string('transaction_fee')->nullable();
                $table->integer('max_orders')->nullable();
                $table->integer('order_count')->default(0);
                $table->date('cutoff_date')->nullable();
                $table->longText('meetup_place')->nullable();
                $table->longText('additional_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
