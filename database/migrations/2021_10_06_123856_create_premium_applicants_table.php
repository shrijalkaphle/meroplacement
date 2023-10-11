<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('premium_job_id')->unsigned();
            $table->foreign('premium_job_id')->references('id')->on('premium_jobs')->onDelete('cascade');
            $table->string('name',150);
            $table->string('email',200);
            $table->string('mobile',15);
            $table->string('address',150);
            $table->string('education',200);
            $table->string('resume',150);
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
        Schema::dropIfExists('premium_applicants');
    }
}
