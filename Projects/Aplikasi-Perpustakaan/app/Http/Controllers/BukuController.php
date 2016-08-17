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

    public function cariBuku(Request $request)
    {
        $key = $request->key;
        $value = $request->value;

        $buku = Buku::where($key, 'like', '%' . $value . '%')->paginate(10);
        return view('buku.index', ['bukus' => $buku]);
    }

    public function tambahBuku()
    {
        return view('buku.create');
    }

    public function simpanBuku(Request $request)
    {
        $this->validate($request, [
            'judul_buku' => 'required|max:50',
            'nama_pengarang' => 'required|max:50',
            'tahun_terbit' => 'required|integer',
            'penerbit' => 'required|max:50',
            'jumlah_buku' => 'required|integer',
            'nomor_rak_buku' => 'required|max:50',
        ]);

        $buku = new Buku;

        $buku->id_buku = Uuid::uuid4();
        $buku->judul_buku = $request->judul_buku;
        $buku->nama_pengarang = $request->nama_pengarang;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->penerbit = $request->penerbit;
        $buku->jumlah_buku = $request->jumlah_buku;
        $buku->nomor_rak_buku = $request->nomor_rak_buku;

        $buku->save();

        \Session::flash('flash_message', 'data buku berhasil disimpan');

        return redirect('Buku');
    }

    public function editBuku($idBuku)
    {
        $buku = Buku::where('id_buku', $idBuku)->firstOrFail();
        return view('buku.edit')
            ->with('buku', $buku);
    }

    public function updateBuku(Request $request, $idBuku)
    {

        $buku = Buku::where('id_buku', $idBuku)->firstOrFail();

        $this->validate($request, [
            'id_buku' => 'required',
            'judul_buku' => 'required|max:50',
            'nama_pengarang' => 'required|max:50',
            'tahun_terbit' => 'required|integer',
            'penerbit' => 'required|max:50',
            'jumlah_buku' => 'required|integer',
            'nomor_rak_buku' => 'required|max:50'
        ]);

        Buku::where('id_buku', $buku->id_buku)
            ->update([
                'judul_buku' => $request->judul_buku,
                'nama_pengarang' => $request->nama_pengarang,
                'tahun_terbit' => $request->tahun_terbit,
                'penerbit' => $request->penerbit,
                'jumlah_buku' => $request->jumlah_buku,
                'nomor_rak_buku' => $request->nomor_rak_buku
            ]);

        \Session::flash('flash_message', 'data buku berhasil diubah');

        return redirect('Buku');
    }

    public function hapusBuku($idBuku)
    {
        $buku = Buku::where('id_buku', $idBuku)->firstOrFail();
        Buku::where('id_buku', $buku->id_buku)->delete();

        \Session::flash('flash_message', 'data buku berhasil dihapus');

        return redirect('Buku');
    }
}
