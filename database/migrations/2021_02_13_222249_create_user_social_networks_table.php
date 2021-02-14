<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_social_networks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->enum('provider', ['facebook','google'])->nullable();
            $table->string('provider_id')->nullable();
            $table->string('expires_in')->nullable();
            $table->longText('token')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->longText('avatar_normal')->nullable();
            $table->longText('avatar_original')->nullable();
            $table->boolean('verified_email')->nullable();
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
        Schema::dropIfExists('user_social_networks');
    }
}
