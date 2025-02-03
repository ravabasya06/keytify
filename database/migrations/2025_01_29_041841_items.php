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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('name');
            // keyboard, switch, pcb, dll
            $table->string('slug')->unique(); 
            $table->unsignedBigInteger('category_id');
            // cherry, akko dll
            $table->unsignedBigInteger('brand_id')->nullable();
            // contoh type, tkl, fullsize, dll
            $table->string('type')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('price');
            $table->text('short_desc');
            // kalo misalnya desc kosong, masukin short desc aja ke profile item nya
            $table->text('desc')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->timestamps();
            
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
