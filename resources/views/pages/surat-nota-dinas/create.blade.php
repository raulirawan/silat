@extends('layouts.dashboard')

@section('title', 'Halaman Surat Nota Dinas')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Surat Nota Dinas</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Surat Nota Dinas</a></li>
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
                            <strong class="card-title">Form Tambah Surat Nota Dinas</strong>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('nota.dinas.store') }}" method="post"
                                novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Yth</label>
                                    <select name="yth_id" id="yth_id" class="form-control" required>
                                        <option value="">Pilih Yth</option>
                                        @foreach (App\Yth::all() as $yth)
                                            <option value="{{ $yth->id }}">{{ $yth->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Dari</label>
                                    <input type="text" name="dari" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Biro</label>
                                    <select name="biro_id" id="biro_id" class="form-control" required>
                                        <option value="">Pilih Biro</option>
                                        @foreach (App\Biro::all() as $biro)
                                            <option value="{{ $biro->id }}">{{ $biro->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Tanggal Surat</label>
                                    <input type="text" name="tanggal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nomor Surat</label>
                                    <input type="text" name="nomor_surat" spellcheck="true" class="form-control"
                                        >
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Sifat Surat</label>
                                    <input type="text" name="sifat" spellcheck="true" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">NIP</label>
                                    <input type="text" name="nip" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nama Kepala Bagian</label>
                                    <input type="text" name="nama_kepala" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Judul Lampiran</label>
                                    <input type="text" name="lampiran" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Hal</label>
                                    <input type="text" name="hal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Pembuka</label>
                                    <textarea name="pembuka" id="pembuka" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Isi</label>
                                    <textarea name="isi" id="isi" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Penutup</label>
                                    <textarea name="penutup" id="penutup" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Tembusan</label>
                                    <textarea name="tembusan" id="tembusan" class="form-control" required></textarea>
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
                selector: 'textarea#pembuka',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true
            });
            tinymce.init({
                selector: 'textarea#isi',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true
            });
            tinymce.init({
                selector: 'textarea#penutup',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true
            });
            tinymce.init({
                selector: 'textarea#tembusan',
                plugins: 'lists',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                lists_indent_on_tab: true
            });
        </script>
        {{-- <script src="https://cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
        <script>
            CKEDITOR.addCss('.cke_editable p { line-height: 1.5 !important; }');
            CKEDITOR.replace('pembuka', {
                height: 400,
                baseFloatZIndex: 10005,
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('isi', {
                height: 400,
                baseFloatZIndex: 10005,
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('penutup', {
                height: 400,
                baseFloatZIndex: 10005,
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('tembusan', {
                height: 400,
                baseFloatZIndex: 10005,
                removeButtons: 'PasteFromWord'
            });
        </script> --}}
    @endpush
@endsection
