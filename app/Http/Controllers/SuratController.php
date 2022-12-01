<?php

namespace App\Http\Controllers;

use App\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
    public function sendEmail($jenisSurat, $surat_id)
    {
        $surat = Surat::find($surat_id);

        if ($jenisSurat == 'lama') {
            $file = asset($surat->file_dokumen_old);
        } else {
            if (file_exists(asset($surat->file_dokumen_new))) {
                $file = asset($surat->file_dokumen_new);
            } else {
                return redirect()->back()->with('error', 'Surat Belum Tersedia');
            }
        }
        $data = [
            'email' => Session::get('email'),
        ];
        Mail::send('email.surat', ['data' => $data], function ($message) use ($data, $surat, $file) {
            $message->to($data['email'], $data['email'])
                ->subject('Surat Anda')
                ->attach($file);
        });

        return redirect()->back()->with('success', 'Berhasil Kirim Email');
    }
}
