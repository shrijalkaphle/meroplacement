<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->integer('qualification_id')->unsigned();
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
            $table->string('program',150);
            $table->string('board',150);
            $table->string('institute_name',150);
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('job_seeker_education');
    }
}
