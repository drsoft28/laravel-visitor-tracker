<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('visitor_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('host_schema')->nullable();
            $table->string('host')->nullable();
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->string('full_url')->nullable();
            $table->string('route_name')->nullable();
            $table->json('route_params')->nullable();
            $table->json('request_info')->nullable();
            $table->string('ip')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('region_code')->nullable();
            $table->string('city_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('iso_code')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('metro_code')->nullable();
            $table->string('area_code')->nullable();
            $table->string('timezone')->nullable();
            $table->string('referer')->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('visitor_trackers');
    }
};
