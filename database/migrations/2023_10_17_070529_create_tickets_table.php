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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->longText('description');
            $table->mediumInteger('quantity');
            // $table->mediumInteger('sold')->default(0);
            $table->mediumInteger('price');
            $table->boolean('isBrowse')->default(false);
           // $table->foreignUuid('commission_id')->nullable();
            $table->foreignUuid('seller_id')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
