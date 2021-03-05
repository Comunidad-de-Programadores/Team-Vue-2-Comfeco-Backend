<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComfecoEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comfeco_events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('portrait_image_url')->nullable();
            $table->string('background_image_url')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->longText('content')->nullable();
            $table->integer('participants')->nullable();
            $table->integer('participants_signed')->default(0);
            $table->longText('meeting_url')->nullable();
            $table->longText('external_url')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->tinyInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comfeco_events');
    }
}
