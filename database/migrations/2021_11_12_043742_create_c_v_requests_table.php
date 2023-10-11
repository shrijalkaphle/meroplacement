<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_v_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->date('access_till')->nullable();
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
        Schema::dropIfExists('c_v_requests');
    }
}
