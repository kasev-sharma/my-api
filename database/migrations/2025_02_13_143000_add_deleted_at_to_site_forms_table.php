<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToSiteFormsTable extends Migration
{
    public function up()
    {
        Schema::table('site_forms', function (Blueprint $table) {
            $table->softDeletes();  // Add deleted_at column for soft deletes
        });
    }

    public function down()
    {
        Schema::table('site_forms', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Drop deleted_at column on rollback
        });
    }
}
