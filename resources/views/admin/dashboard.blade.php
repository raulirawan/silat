@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
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
                                        <div class="stat-text"><span class="">{{ App\Surat::count() }}</span></div>
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
                                                class="">{{ App\Surat::where('status', 'PENDING')->count() }}</span>
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
                                                class="">{{ App\Surat::where('status', 'SELESAI')->count() }}</span>
                                        </div>
                                        <div class="stat-heading">Surat Selesai</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Chart </h4>
                            <canvas id="singelBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Widgets -->
            <!--  Traffic  -->

            <!--  /Traffic -->
            <div class="clearfix"></div>
            <!-- Orders -->
            {{-- <div class="orders">
                <div class="row">
                    <div class="col-xl-12">
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
                            <div class="card-body">
                                <h4 class="box-title">Orderan Masuk</h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kode</th>
                                                <th>Nama Customer</th>
                                                <th>Total Harga</th>
                                                <th>Jenis Transaksi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-8 -->


                </div>
            </div> --}}

        </div>
        <!-- .animated -->
    </div>
@endsection

@push('down-script')
    <script>
        (function($) {
            "use strict";
            // single bar chart
            var totalNotaDinas = '{{ App\Surat::where('jenis_surat','Nota Dinas')->count() }}';
            var totalUndangan = '{{ App\Surat::where('jenis_surat','Undangan')->count() }}';
            var totalBiasa = '{{ App\Surat::where('jenis_surat','Biasa')->count() }}';
            var ctx = document.getElementById("singelBarChart");
            ctx.height = 150;
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Total Surat"],
                    datasets: [
                        {
                            label: "Total Nota Dinas",
                            data: [totalNotaDinas],
                            borderColor: "#007BFF",
                            borderWidth: "0",
                            backgroundColor: "#007BFF"
                        },
                        {
                            label: "Total Surat Undangan",
                            data: [totalUndangan],
                            borderColor: "#DC3545",
                            borderWidth: "0",
                            backgroundColor: "#DC3545"
                        },
                        {
                            label: "Total Surat Biasa",
                            data: [totalBiasa],
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
