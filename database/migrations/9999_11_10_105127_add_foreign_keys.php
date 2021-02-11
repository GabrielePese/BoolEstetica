<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        

        Schema::table('service_user', function(Blueprint $table){
            
            $table -> foreign('service_ID', 'us_ser')
                   -> references('ID')
                   ->on('services');

            $table -> foreign('user_ID', 'ser_us')
                   -> references('ID')
                   ->on('users');

        });

        Schema::table('promotions', function(Blueprint $table){
            $table -> foreign('service_ID', 'ser_pro')
                   -> references('ID')
                   ->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_user', function(Blueprint $table){
            $table -> dropForeign('us_ser');
            $table -> dropForeign('ser_us');       

        });

        Schema::table('services', function(Blueprint $table){
            $table -> dropForeign('ser_pro');
               

        });
    }
}
