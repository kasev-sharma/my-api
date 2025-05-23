<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('audio_file_tracker', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('file_name', 255);
        //     $table->string('file_path', 255);
        //     $table->string('status')->default('queued'); // 'queued', 'processing', 'completed', 'error'
        //     $table->text('error_message')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    public function down()
    {
        Schema::dropIfExists('audio_file_tracker');
    }
};
