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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departement_id');
            $table->string('nama', 100);
            $table->string('slug');
            $table->text('deskripsi');
            $table->string('thumbnail')->nullable();
            $table->date('tgl_acara');
            $table->date('start_date'); //waktu buka pendaftaran
            $table->date('end_date'); //waktu tutup pendaftaran
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
