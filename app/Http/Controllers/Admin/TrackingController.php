<?php

namespace App\Http\Controllers\Admin;

use App\Surat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tracking;

class TrackingController extends Controller
{
    public function index($surat_id)
    {
        $surat = Surat::find($surat_id);
        $tracking = Tracking::where('surat_id', $surat_id)->orderBy('created_at','DESC')->get();
        return view('admin.track.index', compact('tracking', 'surat'));
    }

    public function store(Request $request, $surat_id)
    {
        $data = new Tracking();
        $data->surat_id = $surat_id;
        $data->keterangan = $request->keterangan;
        $data->save();


        if ($data != null) {
            return redirect()->route('admin.tracking.surat.index', $surat_id)->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.tracking.surat.index', $surat_id)->with('error', 'Data Gagal di Tambah');
        }
    }
}
