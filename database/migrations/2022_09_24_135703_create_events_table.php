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
            $table->string('thumbnail')->nullable();
            $table->boolean('adanya_kelulusan');
            $table->date('tgl_buka_pendaftaran'); //waktu buka pendaftaran
            $table->date('tgl_tutup_pendaftaran'); //waktu tutup pendaftaran
            $table->date('tgl_buka_pengumuman'); //waktu buka pengumuman
            $table->date('tgl_tutup_pengumuman'); //waktu tutup pengumuman
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
