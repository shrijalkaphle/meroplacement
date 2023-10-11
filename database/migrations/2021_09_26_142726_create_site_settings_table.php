<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta_title',250)->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('about')->nullable();
            $table->longText('footer_about')->nullable();
            $table->longText('termscondition')->nullable();
            $table->string('email',50)->nullable();
            $table->string('number',50)->nullable();
            $table->string('address',50)->nullable();
            $table->string('favicon',100)->nullable();
            $table->string('logo',100)->nullable();
            $table->string('training_banner',100)->nullable();
            $table->string('facebook',50)->nullable();
            $table->string('youtube',50)->nullable();
            $table->string('instagram',50)->nullable();
            $table->string('linkedin',50)->nullable();
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
        Schema::dropIfExists('site_settings');
    }
}
