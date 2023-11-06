@extends('it_admin.layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Create a canvas element for the chart -->
    {{-- <canvas class="chart" id="line-chart"
        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; background-color: white;"></canvas> --}}
    <!-- Customize the input elements -->
    <style>
        .knob {
            width: 60px;
            height: 60px;
            font-size: 18px;
            border: none;
            border-radius: 50%;
            color: white;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $newPermintaan }}</h3>

                            <p>New Permintaan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $openPermintaan }}</h3>

                            <p>Open Permintaan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $overduePermintaan }}</h3>

                            <p>Overdue Permintaan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $closedPermintaan }}</h3>

                            <p>Closed Permintaan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>

                            <p>User Count</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $openPengeluaran }}</h3>

                            <p>Open Pengeluaran Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $overduePengeluaran }}</h3>

                            <p>Overdue Pengeluaran Barang</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>-</h3>

                            <p>New Feedback</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $rejectedPermintaan }}</h3>

                            <p>Rejected Permintaan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('rejectedpermintaaan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $canceledBarangMasuk }}</h3>

                            <p>Canceled Barang Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('canceledbm') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- /.row -->
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text bg-black">
                                {{ __('You are logged in! ha') }}
                                <button type="button" class="btn btn-danger">Danger</button>
                            </p>

                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /.row -->

            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Sales Graph
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas class="chart" id="line-chart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%"></canvas></canvas>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                    <div class="row">
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="20" disabled
                                style="text-align: center;">

                            <div class="text-white">Mail-Orders</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="50" disabled
                                style="text-align: center;">

                            <div class="text-white">Online</div>
                        </div>
                        <!-- ./col -->
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="30" disabled
                                style="text-align: center;">

                            <div class="text-white">In-Store</div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->

    </div>
    <script>
        // Sample data for two lines
        const data = {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18',
                '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'
            ], // Days of the month
            datasets: [{
                    label: 'Mail-Orders',
                    borderColor: 'white', // Set line color to white
                    data: [20, 18, 25, 22, 28, 30, 32, 31, 29, 27, 24, 22, 20, 18, 20, 21, 23, 26, 27, 25, 24, 28,
                        27, 30, 32, 31, 29, 27, 24, 22, 20
                    ],
                },
                {
                    label: 'Online',
                    borderColor: 'yellow', // Set line color to yellow
                    data: [50, 52, 48, 55, 58, 62, 61, 59, 57, 53, 56, 55, 50, 52, 53, 58, 60, 59, 61, 58, 55, 58,
                        62, 61, 59, 57, 53, 56, 55, 50, 52
                    ],
                },
            ],
        };

        const ctx = document.getElementById('line-chart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white', // Change the x-axis label font color to white
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white', // Change the x-axis label font color to white
                        },
                    },
                },
            },
        });
    </script>
    <!-- /.content -->
@endsection
