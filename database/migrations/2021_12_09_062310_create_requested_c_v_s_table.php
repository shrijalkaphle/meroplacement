<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedCVSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_c_v_s', function (Blueprint $table) {
            $table->id();
            $table->integer('job_seeker_id')->unsigned();
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->integer('template')->nullable();
            $table->string('type',15);
            $table->string('file',150);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('requested_c_v_s');
    }
}
