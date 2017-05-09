<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProjectResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('company_project_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('expectedStartDate')->nullable();
            $table->date('expectedEndDate')->nullable();
            $table->date('actualStartDate')->nullable();
            $table->date('actualEndDate')->nullable();
            $table->string('title')->nullable();
            $table->decimal('hourlyBillingRate', 15,2)->nullable();
            $table->integer('hoursPerWeek')->nullable();

            $table->integer('company_project_id')->unsigned()->nullable();
            $table->foreign('company_project_id')->references('id')->on('company_projects');

            $table->integer('employee_id')->unsigned()->nullable();
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
        Schema::dropIfExists('company_project_resources');
        $table->dropForeign('company_project_id');
        $table->dropForeign('employee_id');
    }
}
