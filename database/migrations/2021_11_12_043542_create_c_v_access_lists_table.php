<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVAccessListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_v_access_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->foreign('request_id')->references('id')->on('c_v_requests')->onDelete('cascade');
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
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
        Schema::dropIfExists('c_v_access_lists');
    }
}
