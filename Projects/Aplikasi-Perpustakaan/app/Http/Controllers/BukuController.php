<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;

use App\Http\Requests;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::paginate(10);
        return view('buku.index',['bukus'=>$buku]);
    }

    public function cariBuku(Request $request){
    }
}
