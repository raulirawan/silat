@extends('layouts.dashboard')

@section('title', 'Halaman Surat Undangan')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Surat Undangan</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Surat Undangan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Form Edit Surat Undangan</strong>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('undangan.update', $surat->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Jenis Yth</label>
                                    <select name="pilih_yth" id="pilih_yth" class="form-control" required>
                                        <option value="">Jenis Yth</option>
                                        <option value="terlampir" {{ $surat->pilih_yth == 'terlampir' ? 'selected' : '' }}>
                                            Terlampir</option>
                                        <option value="tidak terlampir"
                                            {{ $surat->pilih_yth == 'tidak terlampir' ? 'selected' : '' }}>Tidak Terlampir
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Yth</label>
                                    <textarea name="yth" id="yth" class="form-control" required>{{ $surat->yth }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Biro</label>
                                    <select name="biro_id" id="biro_id" class="form-control" required>
                                        <option value="">Pilih Biro</option>
                                        @foreach (App\Biro::all() as $biro)
                                            <option value="{{ $biro->id }}"
                                                {{ $biro->id == $surat->biro_id ? 'selected' : '' }}>{{ $biro->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Tanggal Surat</label>
                                    <input type="text" name="tanggal" value="{{ $surat->tanggal }}" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nomor Surat</label>
                                    <input type="text" name="nomor_surat" value="{{ $surat->nomor_surat }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Sifat Surat</label>
                                    <input type="text" name="sifat" value="{{ $surat->sifat }}" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">NIP</label>
                                    <input type="text" name="nip" value="{{ $surat->nip }}" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nama Kepala Bagian</label>
                                    <input type="text" name="nama_kepala" value="{{ $surat->nama_kepala }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" value="{{ $surat->nama_jabatan }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Judul Lampiran</label>
                                    <input type="text" name="lampiran" value="{{ $surat->lampiran }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Hal</label>
                                    <input type="text" name="hal" value="{{ $surat->hal }}" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Hari</label>
                                    <input type="text" name="hari" class="form-control" value="{{ $surat->hari }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Tanggal</label>
                                    <input type="text" name="tanggal_acara" class="form-control"
                                        value="{{ $surat->tanggal_acara }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Pukul</label>
                                    <input type="text" name="pukul" class="form-control"
                                        value="{{ $surat->pukul }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Tempat</label>
                                    <input type="text" name="tempat" class="form-control"
                                        value="{{ $surat->tempat }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Acara</label>
                                    <input type="text" name="acara" class="form-control"
                                        value="{{ $surat->acara }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Tembusan</label>
                                    <textarea name="tembusan" id="tembusan" class="form-control">{{ $surat->tembusan }}</textarea>
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-sm btn-info">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->



    @push('down-script')
        <script src="{{ asset('/') }}assets/js/init/datatables-init.js"></script>
        <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea#yth',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true,
                setup: function(editor) {
                    editor.on('change', function(e) {
                        editor.save();
                    });
                }
            });
            tinymce.init({
                selector: 'textarea#pembuka',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true,
                setup: function(editor) {
                    editor.on('change', function(e) {
                        editor.save();
                    });
                }
            });
            tinymce.init({
                selector: 'textarea#isi',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true,
                setup: function(editor) {
                    editor.on('change', function(e) {
                        editor.save();
                    });
                }
            });
            tinymce.init({
                selector: 'textarea#penutup',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true,
                setup: function(editor) {
                    editor.on('change', function(e) {
                        editor.save();
                    });
                }
            });
            tinymce.init({
                selector: 'textarea#tembusan',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true,
                setup: function(editor) {
                    editor.on('change', function(e) {
                        editor.save();
                    });
                }
            });
        </script>
    @endpush
@endsection
