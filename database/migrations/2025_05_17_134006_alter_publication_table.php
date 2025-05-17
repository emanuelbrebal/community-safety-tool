<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('publications', function (Blueprint $table){
            $table->unsignedTinyInteger('incident_id');
            $table->foreign('incident_id')->references('id')->on('incident_type');
            
            $table->unsignedTinyInteger('urgency_id');
            $table->foreign('urgency_id')->references('id')->on('urgency');

            $table->unsignedBigInteger('media_id')->nullable();
            $table->foreign('media_id')->references('id')->on('publication_media');

            $table->unsignedBigInteger('publication_address_id')->nullable();
            $table->foreign('publication_address_id')->references('id')->on('publication_address');

            $table->date('incident_date');
            $table->time('incident_time');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
