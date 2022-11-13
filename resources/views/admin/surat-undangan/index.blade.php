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
                            <strong class="card-title">Tabel Surat Undangan</strong>
                            <a href="{{ route('admin.surat-undangan.create') }}"
                                class="btn btn-info btn-sm mb-3 float-right">Tambah Surat Undangan</a>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Tanggal Surat</th>
                                            <th>Nama Pegawai</th>
                                            <th>Biro</th>
                                            <th>Sifat</th>
                                            <th>Status</th>
                                            <th style="width: 30%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $item)
                                            <tr>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->user->email ?? 'Tidak Ada' }}</td>
                                                <td>Biro Pemerintahan</td>
                                                <td>{{ $item->sifat }}</td>
                                                <td>
                                                    @if ($item->status == 'PENDING')
                                                        <span class="badge bg-warning">PENDING</span>
                                                    @elseif ($item->status == 'SELESAI')
                                                        <span class="badge bg-success">SELESAI</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.tracking.surat.index', $item->id) }}"
                                                        class="btn btn-secondary btn-sm float-left mr-1">Track</a>
                                                    <button id="upload" data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#modal-upload"
                                                        class="btn btn-success btn-sm float-left mr-1">Upload</button>
                                                    <button id="download" data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#modal-download"
                                                        class="btn btn-info btn-sm float-left mr-1">Download</button>
                                                    <a href="{{ route('admin.surat-undangan.edit', $item->id) }}"
                                                        id="edit"
                                                        class="btn btn-primary btn-sm float-left mr-1">Edit</a>
                                                    <form action="{{ route('admin.surat-undangan.delete', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-upload" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Upload Surat Signed</label>
                                <input type="file" class="form-control" name="file_surat" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a href="#" id="file_lama" class="btn btn-danger">Download File Lama</a>
                        <a href="#" id="file_baru" class="btn btn-success">Download File Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @push('down-script')
            <script>
                $(document).on('click', '#upload', function() {
                    var id = $(this).data('id');

                    $('#form-upload').attr('action', '/admin/upload/' + id);
                });

                $(document).on('click', '#download', function() {
                    var id = $(this).data('id');

                    $('#file_lama').attr('href', '/admin/surat-undangan/download/lama/' + id);
                    $('#file_baru').attr('href', '/admin/surat-undangan/download/baru/' + id);
                });
            </script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/datatables.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/dataTables.buttons.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/jszip.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/vfs_fonts.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/buttons.html5.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/buttons.print.min.js"></script>
            <script src="{{ asset('/') }}assets/js/lib/data-table/buttons.colVis.min.js"></script>
            <script src="{{ asset('/') }}assets/js/init/datatables-init.js"></script>
        @endpush
    @endsection
