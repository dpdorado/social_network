<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_like', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('msg_id');
            $table->unsignedBigInteger('uid');
            
            $table->foreign('uid')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('msg_id')
                ->references('id')
                ->on('messages')
                ->onDelete('cascade');

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
        Schema::dropIfExists('message_like');
    }
}
