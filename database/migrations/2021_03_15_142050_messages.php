<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('from')->comment('来自');
            $table->string('to')->comment('发送到');
            $table->string('channel')->comment('频道');
            $table->longText('message')->comment('消息内容');
            $table->string('type')->comment('消息类型')->default('text');
            $table->dateTime('read_at')->nullable()->comment('已读时间');
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
        Schema::dropIfExists('messages');
    }
}
