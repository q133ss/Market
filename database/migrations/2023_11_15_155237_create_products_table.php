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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id');
            $table->foreignId('shop_id');
            $table->string('compound')->nullable()->comment('Состав');
            $table->unsignedInteger('price');
            $table->unsignedInteger('old_price')->nullable();
            $table->string('phone')->nullable();
            $table->text('description');
            $table->text('shipping')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->foreignId('city_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
