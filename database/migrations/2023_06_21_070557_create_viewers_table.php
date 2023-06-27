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
            $table->unsignedBigInteger('post_id')->constrained()->cascadeOnDelete()->default(0);;
            $table->unsignedBigInteger('visitor')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('viewers');
    }
}
