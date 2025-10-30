<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\SupabaseStorage;
use Illuminate\Foundation\Auth\User;

class ProfileController extends Controller
{
    private SupabaseStorage $storage;

    public function __construct(SupabaseStorage $storage)
    {
        $this->storage = $storage;
    }

    public function index()
    {
        $iduser  = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();
        return view('profile.tampil', ['profile' => $profile]);
    }

    public function edit()
    {
        $iduser  = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();
        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required',
            'alamat'       => 'required',
            'noTelp'       => 'required',
            'photoProfile' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.required'   => "Nama tidak boleh kosong",
            'alamat.required' => "Alamat tidak boleh kosong",
            'noTelp.required' => "Nomor Telepon tidak boleh kosong",
        ]);

        $iduser  = Auth::id();
        $profile = Profile::where('users_id', $iduser)->first();
        $user    = User::where('id', $iduser)->first();

        if ($request->hasFile('photoProfile')) {
            // hapus lama
            $this->storage->deleteIfExists('images/photoProfile', $profile->photoProfile);
            // upload baru => simpan nama file ke DB
            $profile->photoProfile = $this->storage->uploadPublic('images/photoProfile', $request->file('photoProfile'));
            $profile->save();
        }

        $user->name     = $request->name;
        $profile->alamat = $request->alamat;
        $profile->noTelp = $request->noTelp;

        $profile->save();
        $user->save();

        Alert::success('Success', 'Berhasil Mengubah Profile');
        return redirect('/profile');
    }
}
