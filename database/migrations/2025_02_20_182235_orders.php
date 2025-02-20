<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // tambahin alamat
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable(); // For guests
            $table->integer('total_price');
            $table->string('status')->default('pending'); // pending -> processed -> delivered -> done / cancelled
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
};

