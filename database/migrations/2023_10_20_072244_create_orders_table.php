<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('token')->unique();
            $table->foreignUuid('seller_id')->nullable();
            $table->foreignUuid('ticket_id')->nullable(false);
            $table->foreignUuid('buyer_id')->nullable(false);
            $table->mediumInteger('quantity');
            $table->mediumInteger('quantity_sell')->default(0);
            $table->mediumInteger('total');
            $table->softDeletes();
            //$table->boolean('status')->default(false);
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
        Schema::dropIfExists('orders');
    }
};
