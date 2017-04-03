<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->date('expectedStartDate')->nullable();
            $table->date('expectedEndDate')->nullable();
            $table->date('actualStartDate')->nullable();
            $table->date('actualEndDate')->nullable();
            $table->decimal('budget', 20, 2)->nullable();
            $table->decimal('cost', 20, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_projects');
    }
}
