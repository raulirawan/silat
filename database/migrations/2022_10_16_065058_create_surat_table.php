<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biro_id')->constrained('biro')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('yth')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_kepala')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('nomor_surat', 100)->nullable();
            $table->string('sifat', 100)->nullable();
            $table->string('lampiran', 100)->nullable();
            $table->text('hal')->nullable();
            $table->text('pembuka')->nullable();
            $table->longText('isi')->nullable();
            $table->text('penutup')->nullable();
            $table->longText('tembusan')->nullable();
            $table->string('jenis_surat')->nullable();
            $table->string('file_dokumen_old')->nullable();
            $table->string('file_dokumen_new')->nullable();
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
        Schema::dropIfExists('surat');
    }
}
