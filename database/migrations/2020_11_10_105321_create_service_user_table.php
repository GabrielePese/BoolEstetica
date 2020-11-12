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
            
            $table->dateTime('date_end');
            $table->integer('riview_vote');
            $table->text('riview_text');
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
