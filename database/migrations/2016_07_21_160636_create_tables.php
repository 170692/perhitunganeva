<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dataeva', function(Blueprint $table){
          // $table->date('created_at');
          $table->increments('id');
        //   $table->integer('eva_id')->nullable();
          $table->date('evaluate_at');
        //   $table->primary('evaluate_at');
          $table->integer('planned_value');
          $table->integer('earned_value');
          $table->integer('actual_cost');
          $table->integer('schedule_variance');
          $table->integer('cost_variance');
          $table->float('CPI');
          $table->float('SPI');
          $table->integer('time_at_completion');
          $table->integer('delay_at_completion');
          $table->float('TCPI');
          $table->integer('EAC');
          $table->integer('ETC');
          $table->integer('VAC');
          $table->string('name');
          $table->double('budget_at_completion');
          $table->integer('plan_at_completion');
          $table->timestamps();
        });

        // Schema::table('dataeva', function($table){
        //     $table->('eva_id')->unsigned();
        //     $table->foreign('eva_id')->references('id')->on('dataproject');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('dataeva');
    }
}
