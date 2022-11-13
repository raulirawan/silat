<?php

namespace App\Http\Controllers\Admin;

use App\Tembusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TembusanController extends Controller
{
    public function index()
    {
        $tembusan = Tembusan::all();
        return view('admin.tembusan.index', compact('tembusan'));
    }

    public function store(Request $request)
    {
        $data = new Tembusan();
        $data->nama = $request->nama_tembusan;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.tembusan.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.tembusan.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = Tembusan::findOrFail($id);

        $data->nama = $request->nama_tembusan;
        $data->save();

        if ($data != null) {
            return redirect()->route('admin.tembusan.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.tembusan.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Tembusan::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.tembusan.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.tembusan.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
