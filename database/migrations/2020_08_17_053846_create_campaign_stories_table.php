<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->string('slug');
            $table->string('slug_bn')->nullable();
            $table->longText('description');
            $table->longText('description_bn')->nullable();
            $table->string('cover')->nullable();
            $table->string('type');
            $table->string('file')->nullable();
            $table->date('published_date');
            $table->tinyInteger('status')->default(0);
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('campaign_stories');
    }
}
