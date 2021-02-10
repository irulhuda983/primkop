<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->char('nia', 11)->unique();
            $table->char('nrp', 11)->nullable();
            $table->char('nama', 100);
            $table->integer('pangkat_id');
            $table->integer('instansi_id');
            $table->char('gender');
            $table->char('tempat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat', 256)->nullable();
            $table->string('foto', 256)->nullable();
            $table->integer('is_active');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
