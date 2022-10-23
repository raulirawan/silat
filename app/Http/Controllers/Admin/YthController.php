<?php

namespace App\Http\Controllers\Admin;

use App\Yth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YthController extends Controller
{
    public function index()
    {
        $yth = Yth::all();
        return view('admin.yth.index', compact('yth'));
    }

    public function store(Request $request)
    {
        $data = new Yth();
        $data->nama = $request->nama_yth;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.yth.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.yth.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Yth::findOrFail($id);

        $data->nama = $request->nama_yth;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.yth.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.yth.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Yth::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.yth.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.yth.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
