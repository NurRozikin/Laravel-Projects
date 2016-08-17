<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'tb_peminjaman';
	
	public function buku()
	{
		return $this->belongsTo('App\Buku');
	}
	
	public function mahasiswa()
	{
		return $this->belongsTo('App\Mahasiswa');
	}
}
