<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('training_id')->unsigned();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->string('name',150);
            $table->string('email',150);
            $table->string('mobile',150);
            $table->string('address',200);
            $table->integer('paid')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('training_enrolls');
    }
}
