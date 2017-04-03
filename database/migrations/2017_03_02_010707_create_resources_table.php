<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
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
        Schema::drop('resources');
    }
}
