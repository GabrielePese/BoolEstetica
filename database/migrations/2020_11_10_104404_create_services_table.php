<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->string('type');
            $table->integer('duration');
            $table->decimal('price' , 6,2);
            $table->decimal('originalprice', 6,2) -> nullable();
            $table->string('photo') -> nullable();
            $table->string('video')-> nullable();
            $table->integer('promotion') -> default(0);
            $table->integer('disabled') -> default(0);
            $table->integer('delete') -> default(0);

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
        Schema::dropIfExists('services');
    }
}
