<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::where('roles', 'PEGAWAI')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $email = $request->email;
        if (strpos($email, '@jakarta.go.id')) {
            // bikin user baru
            $user = User::where('email', $email)->first();
            if ($user == null) {
                $newUser = new User();
                $newUser->email = $email;
                $newUser->roles = 'PEGAWAI';
                $newUser->save();
            } else {
                return redirect()->route('admin.pegawai.index')->with('error', 'Data Gagal di Email Sudah Terdaftar');
            }
            return redirect()->route('admin.pegawai.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.pegawai.index')->with('error', 'Email Tidak Valid');
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $data->nama = $request->nama_biro;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.pegawai.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.pegawai.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.pegawai.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.pegawai.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
