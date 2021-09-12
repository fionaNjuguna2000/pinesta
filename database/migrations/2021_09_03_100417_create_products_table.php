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
            $table->string('crawl_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->longText('colorway')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('gender')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('status')->default(config('settings.status.active'));
            $table->float('retail_price')->nullable();
            $table->float('size')->nullable();
            $table->longText('shoe')->nullable();
            $table->timestamp('release_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->nullOnDelete();
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
