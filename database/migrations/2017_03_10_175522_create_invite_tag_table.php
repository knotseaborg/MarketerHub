<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invite_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invite_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();
            $table->foreign('invite_id')->references('id')->on('invites')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invite_tag');
    }
}
