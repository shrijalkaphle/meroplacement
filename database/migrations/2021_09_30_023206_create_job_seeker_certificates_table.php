<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('title',150);
            $table->string('institute_name',150);
            $table->string('duration',150);
            $table->date('obtained_date');
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
        Schema::dropIfExists('job_seeker_certificates');
    }
}
