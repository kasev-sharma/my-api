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
        // Schema::table('audio_file_tracker', function (Blueprint $table) {
        //     //
        //      $table->text('transcript_text')->nullable(); // Adding the transcript_text column
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audio_file_tracker', function (Blueprint $table) {
            //
            $table->dropColumn('transcript_text');
        });
    }
};
