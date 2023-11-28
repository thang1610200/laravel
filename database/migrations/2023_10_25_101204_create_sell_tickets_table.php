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
        Schema::create('sell_tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->foreignUuid('seller_id')->nullable();
            $table->foreignUuid('ticket_id');
            $table->foreignUuid('commission_id');
            $table->mediumInteger('price');
            $table->mediumInteger('quantity');
            $table->mediumInteger('sold')->default(0);
            $table->boolean('isSell')->default(false);
            $table->boolean('isBrowse')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('sell_tickets');
    }
};
