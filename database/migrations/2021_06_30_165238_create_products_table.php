<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section_id');
            $table->bigInteger('category_id');
            $table->string('product_name',3000);
            $table->string('product_code');
            $table->float('product_price');
            $table->float('product_discount')->default(0.00);
            $table->float('product_weight')->default(0.00);
            $table->string('product_video')->nullable();
            $table->string('product_main_image')->nullable();
            $table->text('product_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured', ['yes', 'no']);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
