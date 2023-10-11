<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',150);
            $table->string('slug',150);
            $table->integer('company_id')->unsigned();
            $table->integer('industry_id');
            $table->string('nature',150);
            $table->string('location',150);
            $table->string('education',150);
            $table->string('salary',150);
            $table->date('deadline');
            $table->integer('vacancyno');
            $table->longText('description');
            $table->string('logo',150);
            $table->string('status',20)->default('pending');
            $table->integer('views')->default('0');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
