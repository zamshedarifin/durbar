<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->string('slug');
            $table->string('slug_bn')->nullable();
            $table->text('short_desc');
            $table->text('short_desc_bn')->nullable();
            $table->date('cam_date');
            $table->string('cover');
            $table->tinyInteger('status')->default(0)->comment("0=Pending,1=Ongoing,2=closed");
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
        Schema::dropIfExists('campaigns');
    }
}
