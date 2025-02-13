<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteFormsTable extends Migration
{
    public function up()
    {
        Schema::create('site_forms', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->integer('ups_rating');
            $table->integer('battery_bank');
            $table->integer('battery_capacity');
            $table->integer('pg_gland');
            $table->integer('thumbal');
            $table->integer('nut_bolts');
            $table->integer('farsher_quality');
            $table->integer('battery_to_braker_cable');
            $table->integer('braker_to_ups');
            $table->integer('control_cable');
            $table->integer('ups_to_pannel_cable');
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_forms');
    }
}
