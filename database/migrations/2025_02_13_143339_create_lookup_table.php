<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupTable extends Migration
{
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->id();
            $table->string('lookup_type');   // Type of the lookup (e.g., 'country', 'status')
            $table->string('lookup_code');   // Unique code (e.g., 'US', 'ACTIVE')
            $table->string('lookup_value');  // Descriptive value for the lookup (e.g., 'United States', 'Active')
            $table->integer('sequence')->default(1);  // Sequence number for ordering
            $table->boolean('is_deleted')->default(false); // Soft delete flag
            $table->timestamps(); // Created at & Updated at timestamps
            $table->softDeletes(); // Soft delete support (this adds the deleted_at column)
        });
    }

    public function down()
    {
        Schema::dropIfExists('lookups');
    }
}
