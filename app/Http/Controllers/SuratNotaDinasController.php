<?php

namespace App\Http\Controllers;

use App\User;
use App\Surat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;


class SuratNotaDinasController extends Controller
{

    public function index()
    {
        $user_id = User::where('email', Session::get('email'))->first()->id;
        $surat = Surat::where(['jenis_surat' => 'Nota Dinas', 'user_id' => $user_id])->get();
        return view('pages.surat-nota-dinas.index', compact('surat'));
    }
    public function create()
    {
        return view('pages.surat-nota-dinas.create');
    }

    public function store(Request $request)
    {
        $surat = new Surat();

        $surat->biro_id = $request->biro_id;
        $surat->user_id = User::where('email', Session::get('email'))->first()->id;
        $surat->yth_id = $request->yth_id;
        $surat->dari = $request->dari;
        $surat->tanggal = $request->tanggal;
        $surat->nip = $request->nip;
        $surat->nama_kepala = $request->nama_kepala;
        $surat->nama_jabatan = $request->nama_jabatan;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->sifat = $request->sifat;
        $surat->nama_kepala = $request->nama_kepala;
        $surat->nama_jabatan = $request->nama_jabatan;
        $surat->lampiran = $request->lampiran;
        $surat->hal = $request->hal;
        $surat->pembuka = $request->pembuka;
        $surat->isi = $request->isi;
        $surat->penutup = $request->penutup;
        $surat->tembusan = $request->tembusan;
        $surat->jenis_surat = 'Nota Dinas';
        $surat->save();

        if ($surat != null) {
            return redirect()->route('nota.dinas.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('nota.dinas.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        return view('pages.surat-nota-dinas.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->biro_id = $request->biro_id;
        $surat->user_id = User::where('email', Session::get('email'))->first()->id;
        $surat->yth_id = $request->yth_id;
        $surat->dari = $request->dari;
        $surat->tanggal = $request->tanggal;
        $surat->nip = $request->nip;
        $surat->nama_kepala = $request->nama_kepala;
        $surat->nama_jabatan = $request->nama_jabatan;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->sifat = $request->sifat;
        $surat->nama_kepala = $request->nama_kepala;
        $surat->nama_jabatan = $request->nama_jabatan;
        $surat->lampiran = $request->lampiran;
        $surat->hal = $request->hal;
        $surat->pembuka = $request->pembuka;
        $surat->isi = $request->isi;
        $surat->penutup = $request->penutup;
        $surat->tembusan = $request->tembusan;
        $surat->jenis_surat = 'Nota Dinas';
        $surat->status = 'PENDING';
        $surat->save();

        if ($surat != null) {
            return redirect()->route('nota.dinas.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('nota.dinas.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Surat::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('nota.dinas.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('nota.dinas.index')->with('error', 'Data Gagal di Hapus');
        }
    }

    public function download($jenisSurat, $id)
    {
        $surat = Surat::find($id);
        if ($jenisSurat == 'lama') {
            $doc = new TemplateProcessor('surat/nota-dinas-v1.docx');
            $doc->setValue('YTH', $surat->ythh->nama);
            $doc->setValue('DARI', $surat->dari);
            // $doc->setValue('NOMOR', $surat->nomor_surat);
            $doc->setValue('SIFAT', $surat->sifat);
            $doc->setValue('LAMPIRAN', $surat->lampiran);
            $doc->setValue('HAL', $surat->hal);
            // $doc->setValue('TANGGAL', $surat->tanggal);
            $doc->setValue('NAMAJABATAN', $surat->nama_jabatan);
            $doc->setValue('NAMABIRO', $surat->biro->nama);
            $doc->setValue('NAMABIROSMALL', ucwords(strtolower($surat->biro->nama)));
            $doc->setValue('NIP', $surat->nip);
            $doc->setValue('PEMBUKA', strip_tags($surat->pembuka));
            $doc->setValue('PENUTUP', strip_tags($surat->penutup));
            $doc->setValue('TEMBUSAN', strip_tags($surat->tembusan));
            // create temporary section

            $section = (new PhpWord())->addSection();
            // add html
            Html::addHtml($section, $surat->isi, false, false);

            // get elements in section
            $containers = $section->getElements();

            // clone the html block in the template
            $doc->cloneBlock('htmlblock', count($containers), true, true);

            // replace the variables with the elements
            for ($i = 0; $i < count($containers); $i++) {

                // be aware of using setComplexBlock
                // and the $i+1 as the cloned elements start with #1
                $doc->setComplexBlock('html#' . ($i + 1), $containers[$i]);
            }

            $pathFile = 'surat/nota-dinas-' . $surat->id . '.docx';
            if (file_exists($pathFile)) {
                unlink($pathFile);
            }
            $surat->file_dokumen_old = $pathFile;
            $surat->save();
            // save final document
            $doc->saveAs($pathFile, true);

            $name = 'nota-dinas-' . $surat->id . '.docx';

            $file = $pathFile;

            $headers  = array(
                'Content-Type: application/docx',
            );

            return Response::download($file, $name, $headers);
        }

        if (file_exists($surat->file_dokumen_new)) {
            $name = str_replace('/', '-', $surat->file_dokumen_new);
            $file = $surat->file_dokumen_new;

            $headers  = array(
                'Content-Type: application/docx',
            );

            return Response::download($file, $name, $headers);
        } else {
            return redirect()->route('nota.dinas.index')->with('error', 'Surat Belum Tersedia');
        }
    }
}
