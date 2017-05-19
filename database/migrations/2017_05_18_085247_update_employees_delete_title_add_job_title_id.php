<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeesDeleteTitleAddJobTitleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->dropColumn('jobTitle');
            $table->integer('job_title_id')->unsigned();
            $table->foreign('job_title_id')->references('id')->on('job_titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('jobTitle')->nullable();
            $table->dropForeign('job_title_id');
//            $table->dropColumn('job_title_id');
//            $table->integer('job_title_id')->unsigned();
//            $table->foreign('job_title_id')->references('id')->on('job_titles');
        });
    }
}
