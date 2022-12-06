@extends('layouts.dashboard')

@section('title', 'Halaman Nota Dinas')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Nota Dinas</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Nota Dinas</a></li>
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
                            <strong class="card-title">Form Tambah Nota Dinas</strong>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.surat-nota-dinas.store') }}" method="post">
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
                                    <label class="control-label mb-1">Tanggal Surat</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Sifat Surat</label>
                                    <select name="sifat" id="sifat" class="form-control" required>
                                        <option value="">Pilih Sifat Surat</option>
                                        <option value="Sangat Rahasia">Sangat Rahasia</option>
                                        <option value="Rahasia">Rahasia</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Konfidensial">Konfidensial</option>
                                        <option value="Biasa">Biasa</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Lampiran</label>
                                    <select name="lampiran" id="lampiran" class="form-control" required>
                                        <option value="">Pilih Lampiran</option>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                        <option value="1 satu (berkas)">1 satu (berkas)</option>
                                        <option value="2 satu (berkas)">2 satu (berkas)</option>
                                        <option value="3 satu (berkas)">3 satu (berkas)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Paragraf 1</label>
                                    <textarea name="pembuka" id="pembuka" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Paragraf 2</label>
                                    <textarea name="isi" id="isi" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Paragraf 3</label>
                                    <textarea name="penutup" id="penutup" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tembusan</label>
                                    <select data-placeholder="Pilih Tembusan" multiple class="standardSelect form-control"
                                        name="tembusan[]" required>
                                        @foreach (App\Yth::all() as $tembusan)
                                            <option value="{{ $tembusan->id }}">{{ $tembusan->nama }}</option>
                                        @endforeach
                                    </select>
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



    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets/css/lib/chosen/chosen.min.css') }}">
    @endpush

    @push('down-script')
        <script src="{{ asset('/') }}assets/js/init/datatables-init.js"></script>
        <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="{{ asset('assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>
        <script>
            jQuery(document).ready(function() {
                jQuery(".standardSelect").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%"
                });
            });
        </script>
        <script>
            $('#pilih_yth').on('change', function() {
                if (this.value == 'many') {
                    $("#yth-many").css('display', 'block');
                    $("#yth-one").css('display', 'none');
                } else {
                    $("#yth-many").css('display', 'none');
                    $("#yth-one").css('display', 'block');

                }
            });
        </script>
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
