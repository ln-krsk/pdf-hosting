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
        Schema::create('entries', function (Blueprint $table) {

            $table->id()-> unique();
            $table->foreignId('product_id');
            $table->string('title');
            $table->foreignId('user_id');
            $table->string('pdf')->nullable();
            $table->text('comment')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
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
        Schema::dropIfExists('entries');
    }
};
