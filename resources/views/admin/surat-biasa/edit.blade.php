@extends('layouts.dashboard')

@section('title', 'Halaman Surat biasa')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Surat biasa</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Surat biasa</a></li>
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
                            <strong class="card-title">Form Edit Surat biasa</strong>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.surat-biasa.update', $surat->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    {{-- <label class="control-label mb-1">Jenis Yth</label>
                                    <select name="pilih_yth" id="pilih_yth" class="form-control" required>
                                        <option value="">Jenis Yth</option>
                                        <option value="terlampir">Terlampir</option>
                                        <option value="tidak terlampir">Tidak Terlampir</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Yth</label>
                                    <textarea name="yth" id="yth" class="form-control" required></textarea>
                                </div> --}}
                                    <div class="form-group">
                                        <label class="control-label mb-1">Yth</label>
                                        <select name="yth_id" id="yth_id" class="form-control" required>
                                            <option value="">Pilih Yth</option>
                                            @foreach (App\Yth::all() as $yth)
                                                <option value="{{ $yth->id }}"
                                                    {{ $surat->yth_id == $yth->id ? 'selected' : '' }}>{{ $yth->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Biro</label>
                                        <select name="biro_id" id="biro_id" class="form-control" required>
                                            <option value="">Pilih Biro</option>
                                            @foreach (App\Biro::all() as $biro)
                                                <option value="{{ $biro->id }}">{{ $biro->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="control-label mb-1">Tanggal Surat</label>
                                        <input type="date" name="tanggal" value="{{ $surat->tanggal }}"
                                            class="form-control" required>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Nomor Surat</label>
                                        <input type="text" name="nomor_surat" spellcheck="true" class="form-control">
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="control-label mb-1">Sifat Surat</label>
                                        <select name="sifat" id="sifat" class="form-control" required>
                                            <option value="">Pilih Sifat Surat</option>
                                            <option value="Sangat Rahasia"
                                                {{ $surat->sifat == 'Sangat Rahasia' ? 'selected' : '' }}>Sangat Rahasia
                                            </option>
                                            <option value="Rahasia" {{ $surat->sifat == 'Rahasia' ? 'selected' : '' }}>
                                                Rahasia</option>
                                            <option value="Penting" {{ $surat->sifat == 'Penting' ? 'selected' : '' }}>
                                                Penting</option>
                                            <option value="Konfidensial"
                                                {{ $surat->sifat == 'Konfidensial' ? 'selected' : '' }}>Konfidensial
                                            </option>
                                            <option value="Biasa" {{ $surat->sifat == 'Biasa' ? 'selected' : '' }}>Biasa
                                            </option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">NIP</label>
                                        <input type="text" name="nip" class="form-control" required>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Nama Kepala Bagian</label>
                                        <input type="text" name="nama_kepala" class="form-control" required>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Nama Jabatan</label>
                                        <input type="text" name="nama_jabatan" class="form-control" required>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Lampiran</label>
                                        <select name="lampiran" id="lampiran" class="form-control" required>
                                            <option value="">Pilih Lampiran</option>
                                            <option value="1 satu (berkas)">1 satu (berkas)</option>
                                        </select>
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Hal</label>
                                        <input type="text" name="hal" class="form-control" required>
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="control-label mb-1">Paragraf 1</label>
                                        <textarea name="pembuka" id="pembuka" class="form-control" required>{{ $surat->pembuka }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Paragraf 2</label>
                                        <textarea name="isi" id="isi" class="form-control" required>{{ $surat->isi }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Paragraf 3</label>
                                        <textarea name="penutup" id="penutup" class="form-control" required>{{ $surat->penutup }}</textarea>
                                    </div>
                                    @php
                                        $surat_tembusan = json_decode($surat->tembusan);
                                    @endphp
                                    <div class="form-group">
                                        <label for="">Tembusan</label>
                                         <select data-placeholder="Pilih Tembusan" multiple
                                            class="standardSelect form-control" name="tembusan[]" required>
                                            @foreach (App\Yth::all() as $key => $tembusan)
                                                <option value="{{ $tembusan->id }}"
                                                    {{ in_array($tembusan->id, $surat_tembusan) ? 'selected' : '' }}>
                                                    {{ $tembusan->nama }}
                                                </option>
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
            var pilih_yth = $('#pilih_yth').find(":selected").val();

            if (pilih_yth == 'many') {
                $("#yth-many").css('display', 'block');
                $("#yth-one").css('display', 'none');
            } else {
                $("#yth-many").css('display', 'none');
                $("#yth-one").css('display', 'block');
            }

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
    @endpush
@endsection
