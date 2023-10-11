<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->integer('industry_id')->nullable();
            $table->string('looking_for',50)->nullable();
            $table->longText('specialization')->nullable();
            $table->longText('skills')->nullable();
            $table->longText('languages')->nullable();
            $table->string('location',150)->nullable();
            $table->string('current_salary',150)->nullable();
            $table->string('expected_salary',150)->nullable();
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
        Schema::dropIfExists('job_seeker_preferences');
    }
}
