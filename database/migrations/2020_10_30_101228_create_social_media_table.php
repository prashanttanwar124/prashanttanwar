<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->text('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('youtube')->nullable();
            $table->text('instagram')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('address_link')->nullable();

            //
            $table->longText('about_me')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('education')->nullable();
            $table->longText('languages_skills')->nullable();
            $table->longText('coding_skills')->nullable();
            $table->longText('knowledge')->nullable();
            $table->longText('my_services')->nullable();
            //
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media');
    }
}
