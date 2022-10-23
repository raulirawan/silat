<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function upload(Request $request, $surat_id)
    {
        $data = Surat::find($surat_id);
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $tujuan_upload = 'surat/new-surat/';
            $nama_file = time() . "_" . $file->getClientOriginalName() . '-signed.docx';
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload, $nama_file);

            if (file_exists($data->file_dokumen_new)) {
                unlink($data->file_dokumen_new);
            }
            $data->file_dokumen_new = $tujuan_upload . $nama_file;
        }

        $data->status = 'SELESAI';

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.surat-nota-dinas.index')->with('success', 'Data Berhasil di Upload');
        } else {
            return redirect()->route('admin.surat-nota-dinas.index')->with('error', 'Data Gagal di Upload');
        }
    }
}
