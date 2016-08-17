<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->uuid('id_buku');
			$table->string('judul_buku', 50);
            $table->string('nama_pengarang', 50);
            $table->integer('tahun_terbit');
            $table->string('penerbit', 50);
            $table->integer('jumlah_buku');
            $table->string('nomor_rak_buku', 50);
            $table->timestamps();
			
			$table->primary('id_buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_buku');
    }
}
