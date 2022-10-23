@extends('layouts.dashboard')

@section('title', 'Halaman Tracking Surat')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Track Surat</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Track Surat</a></li>
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
                            <strong class="card-title">Data Tracking Surat ({{ $surat->nomor_surat }}) |
                                {{ $surat->status }}</strong>
                            @php
                                $role = App\User::where('email', Session::get('email'))->first()->roles;
                            @endphp
                            @if ($role == 'ADMIN')
                                <button data-toggle="modal" data-target="#modal-create"
                                    class="btn btn-info btn-sm mb-3 float-right">Tambah Track Surat</button>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($tracking as $val)
                                        <tr>
                                            <td>{{ date('Y-m-d H:i:s', strtotime($val->created_at)) ?? '' }}</td>
                                            <td>{{ $val->keterangan ?? '' }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.tracking.surat.store', $surat->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                {{-- <textarea type="text" class="form-control" value="{{ old('nama_biro') }}"
                                    name="nama_biro" placeholder="Masukan Nama Biro" required> --}}
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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

    @push('down-script')
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
