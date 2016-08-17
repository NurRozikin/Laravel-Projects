<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->string('npm', 8);
            $table->string('nama', 50);
            $table->string('kelas', 6);
            $table->enum('jenis_kelamin', ['pria', 'wanita']);
            $table->text('alamat');
            $table->timestamps();

            $table->primary('npm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tb_mahasiswa');
    }
}
