<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremiumJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('industry_id');
            $table->string('title',150);
            $table->string('slug',150);
            $table->string('address',150);
            $table->string('logo',150);
            $table->date('deadline');
            $table->longtext('description');
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
        Schema::dropIfExists('premium_jobs');
    }
}
