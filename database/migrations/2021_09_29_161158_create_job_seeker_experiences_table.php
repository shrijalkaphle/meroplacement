<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('organization_name',150);
            $table->integer('organization_nature');
            $table->string('organization_location',150);
            $table->string('position',150);
            $table->string('position_level',50);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->longText('responsibilities');
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
        Schema::dropIfExists('job_seeker_experiences');
    }
}
