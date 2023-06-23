<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewersTable extends Migration
{
    public function up()
    {
        Schema::create('viewers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('viewers');
    }
}
