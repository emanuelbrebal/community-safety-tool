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
        Schema::table('incident_type', function (Blueprint $table) {
            $table->unsignedTinyInteger('urgency_id');
            $table->foreign('urgency_id')->references('id')->on('urgency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incident_type', function (Blueprint $table) {
            $table->dropForeign(['urgency_id']);
            $table->dropColumn(('urgency_id'));
        });
    }
};
