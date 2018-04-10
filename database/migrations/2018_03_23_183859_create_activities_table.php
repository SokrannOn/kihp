<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->tinyInteger('trash');
            $table->tinyInteger('publish');
            $table->date('publish_date')->nullable();
            $table->integer('category_id');
            $table->integer('user_added');
            $table->integer('user_modifies')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('reference')->nullable();
            $table->integer('visitor')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
