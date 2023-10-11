<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('gender',8)->nullable();
            $table->date('dob')->nullable();
            $table->string('website',150)->nullable();
            $table->string('nationality',50)->nullable();
            $table->string('current_address',250)->nullable();
            $table->string('permanent_address',250)->nullable();
            $table->string('photo',150)->nullable();
            $table->longText('aboutme')->nullable();
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
        Schema::dropIfExists('job_seekers');
    }
}
