<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbassadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambassadors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('age');
            $table->string('address')->nullable();
            $table->string('email');
            $table->integer('cell_phone');
            $table->string('fb_profile_link');
            $table->string('profession');
            $table->tinyInteger('is_work');
            $table->tinyInteger('send_mail');
            $table->string('question_1');
            $table->string('question_2');
            $table->string('question_3');
            $table->string('question_4');
            $table->string('question_5');
            $table->string('question_6');
            $table->string('question_7');
            $table->string('question_8');
            $table->string('question_9');
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
        Schema::dropIfExists('ambassadors');
    }
}
