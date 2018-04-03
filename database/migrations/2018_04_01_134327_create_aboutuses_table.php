<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutusesTable extends Migration
{

    public function up()
    {
        Schema::create('aboutuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->date('date');
            $table->boolean('publish');
            $table->boolean('trash');
            $table->integer('user_id');
            $table->integer('user_modify');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('aboutuses');
    }
}
