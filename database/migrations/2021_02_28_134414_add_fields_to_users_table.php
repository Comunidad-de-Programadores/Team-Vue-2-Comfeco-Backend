<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable()->after('email');
            $table->date('birthday')->nullable()->after('email');
            $table->longText('avatar')->nullable()->after('email');
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId('area_id')->nullable()->constrained();
            $table->string('genre')->nullable()->after('email');
            $table->string('biography')->nullable()->after('email');
            $table->string('facebook_url')->nullable()->after('email');
            $table->string('linkedin_url')->nullable()->after('email');
            $table->string('github_url')->nullable()->after('email');
            $table->string('twitter_url')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickname');
            $table->dropColumn('birthday');
            $table->dropColumn('avatar');
            $table->dropForeign('users_country_id_foreign');
            $table->dropColumn('country_id');
            $table->dropForeign('users_area_id_foreign');
            $table->dropColumn('area_id');
            $table->dropColumn('genre');
            $table->dropColumn('biography');
            $table->dropColumn('facebook_url');
            $table->dropColumn('linkedin_url');
            $table->dropColumn('github_url');
            $table->dropColumn('twitter_url');
        });
    }
}
