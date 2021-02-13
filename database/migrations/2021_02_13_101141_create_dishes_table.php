<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('ingredients', 100)->nullable();
            $table->text('description')->nullable();
            $table->unsignedDecimal('unit_price', 3,2);
            $table->boolean('visible')->default(0);
            $table->string('slug')->unique();
            $table->string('img_cover')->nullable();
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
        Schema::dropIfExists('dishes');
    }
}
