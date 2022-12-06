@extends('layouts.dashboard')

@section('title', 'Dashboard Pegawai')

<style>
    .stat-text span {
        color: #fff;
    }

    .stat-heading {
        color: #fff !important;
    }

    .stat-icon i {
        color: #fff;
    }
</style>
@section('content')
    @php
        $user_id = App\User::where('email', Session::get('email'))->first()->id;
    @endphp
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body bg-primary">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-mail"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span
                                                class="">{{ App\Surat::where('user_id', $user_id)->count() }}</span>
                                        </div>
                                        <div class="stat-heading">Total Surat</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body bg-danger">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-mail-open"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span
                                                class="">{{ App\Surat::where('user_id', $user_id)->where('status', 'PENDING')->count() }}</span>
                                        </div>
                                        <div class="stat-heading">Surat Pending</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body bg-success">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-mail-open-file"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span
                                                class="">{{ App\Surat::where('user_id', $user_id)->where('status', 'SELESAI')->count() }}</span>
                                        </div>
                                        <div class="stat-heading">Surat Selesai</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Widgets -->
            <!--  Traffic  -->

            <!--  /Traffic -->
            <div class="clearfix"></div>
            <!-- Orders -->
            {{-- <div class="container-fluid"> --}}
            <div class="row">
                <div class="col-12">

                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Layanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="container" data-aos="fade-up">

                                <header class="section-header text-center mt-5 mb-5">
                                    <h2>Silahkan pilih </h2>
                                </header>

                                <div class="row mb-5">

                                    <div class="col-lg-2 mt-2 mt-lg-0"></div>

                                    <div class="col-lg-4 mt-4 mt-lg-0">
                                        <a href="#" data-toggle="modal" data-target="#modal-surat">
                                            <div class="text-center" style="border: solid 1px #ebebeb; border-radius: 20px">
                                                <img src="{{ asset('assets/letter.png') }}" class="img-fluid w-75"
                                                    alt="">
                                                <div class="text-center mt-2">
                                                    <h4>Persuratan</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-4 mt-4 mt-lg-0">
                                        <a href="#">
                                            <div class="text-center" style="border: solid 1px #ebebeb; border-radius: 20px">
                                                <img src="{{ asset('assets/letter.png') }}" class="img-fluid w-75"
                                                    alt="">
                                                <div class="text-center mt-2">
                                                    <h4>Perundangan</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-2 mt-2 mt-lg-0"></div>

                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Chart </h4>
                            <canvas id="singelBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /.row -->
            {{-- </div> --}}
        </div>
        <!-- .animated -->
    </div>

    <div class="modal fade" id="modal-surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a href="{{ route('nota.dinas.create') }}" class="btn btn-info btn-sm">Nota Dinas</a>
                        <a href="{{ route('undangan.create') }}" class="btn btn-success btn-sm">Surat Undangan</a>
                        <a href="{{ route('biasa.create') }}" class="btn btn-success btn-sm">Surat biasa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('down-script')
    <script>
        (function($) {
            "use strict";
            // single bar chart
            var totalSurat = '{{ App\Surat::where('user_id', $user_id)->count() }}';
            var pending = '{{ App\Surat::where('user_id', $user_id)->where('status', 'PENDING')->count() }}';
            var success = '{{ App\Surat::where('user_id', $user_id)->where('status', 'SELESAI')->count() }}';
            var ctx = document.getElementById("singelBarChart");
            ctx.height = 150;
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Total Surat"],
                    datasets: [
                        {
                            label: "Total Surat",
                            data: [totalSurat],
                            borderColor: "#007BFF",
                            borderWidth: "0",
                            backgroundColor: "#007BFF"
                        },
                        {
                            label: "Surat Pending",
                            data: [pending],
                            borderColor: "#DC3545",
                            borderWidth: "0",
                            backgroundColor: "#DC3545"
                        },
                        {
                            label: "Surat Selesai",
                            data: [success],
                            borderColor: "#28A745",
                            borderWidth: "0",
                            backgroundColor: "#28A745"
                        },
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });


        })(jQuery);
    </script>
@endpush
