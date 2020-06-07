<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description');
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('vehicle_id')->unsigned()->index();
            $table->date('date_set');
            $table->time('time_start');
            $table->time('time_end');
            $table->boolean('is_in_progress');
            $table->boolean('is_cleared');
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
        Schema::dropIfExists('services');
    }
}
