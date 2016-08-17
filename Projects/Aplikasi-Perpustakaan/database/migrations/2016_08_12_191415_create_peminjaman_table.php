<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_peminjaman', function (Blueprint $table) {
            $table->uuid('id_peminjaman');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_batas_pengembalian');
            $table->timestamps();

            $table->primary('id_peminjaman');

			//relasi foreign key
            $table->string('npm', 8);
            $table->char('id_buku', 36);

            $table->foreign('npm')
                ->references('npm')
                ->on('tb_mahasiswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_buku')
                ->references('id_buku')
                ->on('tb_buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_peminjaman');
    }
}
