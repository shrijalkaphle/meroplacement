<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('role',15);
            $table->string('email',200);
            $table->string('number',15)->nullable();
            $table->string('token',200);
            $table->string('provider',100)->nullable();
            $table->string('provider_id',100)->nullable();
            $table->boolean('email_verified')->default('0');
            $table->string('password',200)->nullable();
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
        Schema::dropIfExists('users');
    }
}
