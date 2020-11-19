<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('service_ID') -> unsigned();
            $table->bigInteger('user_ID') -> unsigned();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('review_vote')->nullable();
            $table->text('review_text')-> nullable();
            $table->boolean('deleted') -> default(0);

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
        Schema::dropIfExists('service_user');
    }
}
