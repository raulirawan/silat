<?php

namespace App\Http\Controllers\Admin;

use App\Biro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BiroController extends Controller
{
    public function index()
    {
        $biro = Biro::all();
        return view('admin.biro.index', compact('biro'));
    }

    public function store(Request $request)
    {
        $data = new Biro();
        $data->nama = $request->nama_biro;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.biro.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.biro.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Biro::findOrFail($id);

        $data->nama = $request->nama_biro;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.biro.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.biro.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Biro::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.biro.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.biro.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
