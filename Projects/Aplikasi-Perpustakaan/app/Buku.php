<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'tb_buku';
	
	public function peminjamans()
	{
		return $this->hasMany('App\Peminjaman');
	}
}
