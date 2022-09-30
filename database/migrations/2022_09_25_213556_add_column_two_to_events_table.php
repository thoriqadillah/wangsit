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
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //
            $table->string('slug')->after('departement_id');
            $table->string('thumbnail')->nullable()->after('end_date');
            $table->string('spreadsheet_url')->after('thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //

            $table->dropColumn('slug');
            $table->dropColumn('thumbnail');
            $table->dropColumn('spreadsheet_url');
        });
    }
};
