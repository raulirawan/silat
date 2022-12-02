<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Surat;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;


class SuratUndanganController extends Controller
{
    public function index()
    {
        $surat = Surat::where('jenis_surat', 'Undangan')->get();
        return view('admin.surat-undangan.index', compact('surat'));
    }

    public function create()
    {
        return view('admin.surat-undangan.create');
    }

    public function store(Request $request)
    {
        $surat = new Surat();
        $surat->yth = json_encode($request->yth);
        $surat->user_id = User::where('email', Session::get('email'))->first()->id;
        $surat->sifat = $request->sifat;
        $surat->tanggal = $request->tanggal;
        $surat->lampiran = $request->lampiran;
        $surat->hari = $request->hari;
        $surat->tanggal_acara = $request->tanggal_acara;
        $surat->pukul = $request->pukul;
        $surat->tempat = $request->tempat;
        $surat->acara = $request->acara;
        $surat->tembusan = json_encode($request->tembusan);
        $surat->jenis_surat = 'Undangan';
        $surat->status = 'PENDING';
        $surat->save();

        $roles = User::where('email', Session::get('email'))->first()->roles;
        if ($roles == 'ADMIN') {
            if ($surat != null) {
                return redirect()->route('admin.surat-undangan.index')->with('success', 'Data Berhasil di Tambah');
            } else {
                return redirect()->route('admin.surat-undangan.index')->with('error', 'Data Gagal di Tambah');
            }
        }
        if ($surat != null) {
            return redirect()->route('undangan.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('undangan.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);

        return view('admin.surat-undangan.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $surat->yth = json_encode($request->yth);

        $surat->sifat = $request->sifat;
        $surat->tanggal = $request->tanggal;
        $surat->lampiran = $request->lampiran;
        $surat->hari = $request->hari;
        $surat->tanggal_acara = $request->tanggal_acara;
        $surat->pukul = $request->pukul;
        $surat->tempat = $request->tempat;
        $surat->acara = $request->acara;
        $surat->tembusan = json_encode($request->tembusan);
        $surat->jenis_surat = 'Undangan';
        $surat->save();

        $roles = User::where('email', Session::get('email'))->first()->roles;
        if ($roles == 'ADMIN') {
            if ($surat != null) {

                return redirect()->route('admin.surat-undangan.index')->with('success', 'Data Berhasil di Update');
            } else {
                return redirect()->route('admin.surat-undangan.index')->with('error', 'Data Gagal di Update');
            }
        }
        if ($surat != null) {

            return redirect()->route('undangan.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('undangan.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Surat::findOrFail($id);


        $roles = User::where('email', Session::get('email'))->first()->roles;
        if ($roles == 'ADMIN') {
            if ($data != null) {
                $data->delete();
                return redirect()->route('admin.surat-undangan.index')->with('success', 'Data Berhasil di Hapus');
            } else {
                return redirect()->route('admin.surat-undangan.index')->with('error', 'Data Gagal di Hapus');
            }
        }
        if ($data != null) {
            $data->delete();
            return redirect()->route('undangan.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('undangan.index')->with('error', 'Data Gagal di Hapus');
        }
    }

    public function download($jenisSurat, $id)
    {
        $surat = Surat::find($id);

        if ($jenisSurat == 'lama') {
            $countYth = count(json_decode($surat->yth));

            if ($countYth <= 5) {
                $doc = new TemplateProcessor('surat/surat-undangan-one-yth.docx');
            } else {
                $doc = new TemplateProcessor('surat/surat-undangan-v1.docx');
            }

            $doc->setValue('SIFAT', $surat->sifat);
            $doc->setValue('LAMPIRAN', $surat->lampiran == 'Tidak Ada' ? '-' : $surat->lampiran);
            $doc->setValue('HARI', $surat->hari);
            $doc->setValue('TANGGALACARA', Helper::dateFormat($surat->tanggal_acara));
            $doc->setValue('PUKUL', $surat->pukul);
            $doc->setValue('TEMPAT', $surat->tempat);
            $doc->setValue('ACARA', $surat->acara);
            // $doc->setValue('TEMBUSAN', strip_tags($surat->tembusan));
            // create temporary section

            // YTH BLOCK
            $yth = $surat->yth;
            $htmlYth = view('admin.yth-template', compact('yth'))->render();
            // yth
            $section = (new PhpWord())->addSection();
            // add html
            Html::addHtml($section, $htmlYth, false, false);

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

            // TEMBUSAN BLOCK
            $tembusan = $surat->tembusan;
            if(count(json_decode($tembusan)) >= 2) {
                $htmlTembusan = view('admin.tembusan-template-list', compact('tembusan'))->render();
            }else {
                $htmlTembusan = view('admin.tembusan-template', compact('tembusan'))->render();
            }

            $section = (new PhpWord())->addSection();
            // add html
            Html::addHtml($section, $htmlTembusan, false, false);

            // get elements in section
            $containers = $section->getElements();
            $doc->cloneBlock('blocktembusan', count($containers), true, true);

            for ($i = 0; $i < count($containers); $i++) {

                // be aware of using setComplexBlock
                // and the $i+1 as the cloned elements start with #1
                $doc->setComplexBlock('tembusan#' . ($i + 1), $containers[$i]);
            }


            $pathFile = 'surat/undangan-' . $surat->id . '.docx';
            if (file_exists($pathFile)) {
                unlink($pathFile);
            }
            $surat->file_dokumen_old = $pathFile;
            $surat->save();
            // save final document
            $doc->saveAs($pathFile, true);

            $name = 'undangan-' . $surat->id . '.docx';

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
            $roles = User::where('email', Session::get('email'))->first()->roles;
            if ($roles == 'ADMIN') {
                return redirect()->route('admin.surat-undangan.index')->with('error', 'Surat Belum Tersedia');
            }
            return redirect()->route('undangan.index')->with('error', 'Surat Belum Tersedia');
        }
    }
}
