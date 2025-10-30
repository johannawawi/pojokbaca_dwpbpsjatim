<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Profile;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\SupabaseStorage;

class BukuController extends Controller
{
    private SupabaseStorage $storage;

    public function __construct(SupabaseStorage $storage)
    {
        $this->storage = $storage;
    }

    public function index(Request $request)
    {
        $buku = $request->has('search')
            ? Buku::where('judul','like','%'.$request->search.'%')->paginate(6)
            : Buku::paginate(6);

        $iduser  = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();

        return view('buku.tampil', [
            'buku'    => $buku,
            'profile' => $profile
        ]);
    }

    public function create()
    {
        $kategori = Kategori::all();
        $buku     = Buku::all();
        $iduser   = Auth::id();
        $profile  = Profile::where('users_id', $iduser)->first();

        return view('buku.tambah', [
            'buku'     => $buku,
            'profile'  => $profile,
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required',
            'kode_buku'     => 'required|unique:buku',
            'kategori_buku' => 'required',
            'pengarang'     => 'required',
            'penerbit'      => 'required',
            'tahun_terbit'  => 'required',
            'deskripsi'     => 'required',
            'gambar'        => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul'        => $request->input('judul'),
            'kode_buku'    => $request->input('kode_buku'),
            'pengarang'    => $request->input('pengarang'),
            'penerbit'     => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'deskripsi'    => $request->input('deskripsi'),
        ];

        // Upload ke Supabase (simpan nama file saja)
        if ($request->hasFile('gambar')) {
            $namaFile       = $this->storage->uploadPublic('images/buku', $request->file('gambar'));
            $data['gambar'] = $namaFile;
        }

        $buku = Buku::create($data);
        $buku->kategori_buku()->sync($request->kategori_buku);

        Alert::success('Berhasil', 'Berhasil Menambahkan Data Buku');
        return redirect('/buku');
    }

    public function show($id)
    {
        $buku    = Buku::find($id);
        $iduser  = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();

        return view('buku.detail', ['buku' => $buku, 'profile' => $profile]);
    }

    public function edit($id)
    {
        $iduser  = Auth::id();
        $kategori= Kategori::all();
        $profile = Profile::where('users_id', $iduser)->first();
        $buku    = Buku::find($id);

        return view('buku.edit', [
            'buku'     => $buku,
            'profile'  => $profile,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'tahun_terbit' => 'required',
            'deskripsi'    => 'required',
            'gambar'       => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada gambar baru: hapus lama, upload baru, simpan nama file baru
        if ($request->hasFile('gambar')) {
            $this->storage->deleteIfExists('images/buku', $buku->gambar);
            $buku->gambar = $this->storage->uploadPublic('images/buku', $request->file('gambar'));
        }

        $buku->judul        = $request->judul;
        $buku->pengarang    = $request->pengarang;
        $buku->penerbit     = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->deskripsi    = $request->deskripsi;
        $buku->kategori_buku()->sync($request->kategori_buku);
        $buku->save();

        Alert::success('Berhasil', 'Update Berhasil');
        return redirect('/buku');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);

        // Hapus file di storage juga biar irit space
        $this->storage->deleteIfExists('images/buku', $buku->gambar);

        $buku->delete();

        Alert::success('Berhasil', 'Buku Berhasil Terhapus');
        return redirect('buku');
    }
}
