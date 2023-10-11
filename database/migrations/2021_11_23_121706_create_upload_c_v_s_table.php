<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadCVSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_c_v_s', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('email',200);
            $table->string('number',15);
            $table->string('education',200);
            $table->string('address');
            $table->string('cv',100);
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
        Schema::dropIfExists('upload_c_v_s');
    }
}
