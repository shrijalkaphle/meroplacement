<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',150);
            $table->string('slug',150);
            $table->date('start_date');
            $table->string('duration',150);
            $table->string('image',150);
            $table->longText('description');
            $table->integer('fee');
            $table->string('trainer_name',150);
            $table->string('trainer_image',150);
            $table->longText('trainer_description');
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
        Schema::dropIfExists('trainings');
    }
}
