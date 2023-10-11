<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_references', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('name',50)->nullable();
            $table->string('position',50)->nullable();
            $table->string('organization_name',150)->nullable();
            $table->string('email',150)->nullable();
            $table->string('contact_home',15)->nullable();
            $table->string('contact_mobile',15)->nullable();
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
        Schema::dropIfExists('job_seeker_references');
    }
}
