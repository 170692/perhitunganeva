<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dataproject',function(Blueprint $table){
          // $table->date('created_at');
          $table->increments('id');
          $table->string('name');
          $table->double('budget_at_completion');
          $table->integer('plan_at_completion');
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
        //
        Schema::drop('dataproject');
    }
}
