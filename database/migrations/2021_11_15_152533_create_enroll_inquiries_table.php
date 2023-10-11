<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('training_id')->unsigned();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->string('name',150);
            $table->string('email',150);
            $table->string('mobile',150);
            $table->string('address',200);
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
        Schema::dropIfExists('enroll_inquiries');
    }
}
