<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('expectedStartDate')->nullable();
            $table->date('expectedEndDate')->nullable();
            $table->date('actualStartDate')->nullable();
            $table->date('actualEndDate')->nullable();
            $table->string('title')->nullable();
            $table->decimal('hourlyBillingRate', 15,2)->nullable();
            $table->integer('hoursPerWeek')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_resources');
    }
}
