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
            
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');

            $table->integer('client_project_id')->unsigned()->nullable();
            $table->foreign('client_project_id')->references('id')->on('client_projects');

            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees');
        
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
