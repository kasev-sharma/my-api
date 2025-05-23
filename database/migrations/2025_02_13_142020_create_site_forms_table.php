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
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');
            $table->string('customer_mobile');
            $table->string('site_address');
            $table->string('ups_make');
            $table->string('ups_model');
            $table->integer('ups_rating');
            $table->integer('no_of_ups');
            $table->string('battery_bank');
            $table->string('battery_ah');
            $table->string('battery_volt');
            $table->string('battery_type');
            $table->integer('no_of_bank');
            $table->integer('no_of_battery');
            $table->integer('control_cable_in_meters');
            $table->integer('pg_gland');
            $table->integer('thumbal');
            $table->integer('nut_bolts');
            $table->json('images')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_forms');
    }
}
