<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_footer')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('ga_code')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('operational_time')->nullable();
            $table->string('google_map')->nullable();
            $table->string('address')->nullable();
            $table->string('about_title')->nullable();
            $table->string('about_thumbnail')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
}