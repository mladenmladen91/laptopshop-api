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
            $table->string('name')->index();
            $table->string('brand')->nullable();
            $table->text('brand_image')->nullable();
            $table->decimal('price', 10,2);
            $table->decimal('price_old', 10,2)->nullable();
            $table->decimal('saving', 10,2)->nullable();
            $table->text('small_image')->nullable();
            $table->text('image')->nullable();
            $table->text('big_image')->nullable();
            $table->string('gift_url')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('rating', 10,2)->default(0);
            $table->integer('votes')->default(0);
            $table->integer('shock')->default(0);
            $table->integer('top')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("product_categories")->onDelete("cascade");
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
