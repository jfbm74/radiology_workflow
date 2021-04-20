@extends('layouts.layouts')

@section('after-styles')
    <!-- Plugins css -->
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">--}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"
        integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g=="
        crossorigin="anonymous" />


@endsection

@section('content')

    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="mb-4">
                        <h4>Bienvenido, {{ Auth()->user()->name }}</h4>
                        <small><a href="#"></a></small>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-6 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body ribbon">
                            <a href="" class="my_sort_cut text-muted">
                                <i class="icon-users"></i>
                                <span>Pacientes <small>(30 días)</small></span>
                                <span><strong> {{$monthly_patients}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <a href="#" class="my_sort_cut text-muted">
                                <i class="fa fa-paste"></i>
                                <span>Órdenes <small>(30 días)</small></span>
                                <span><strong> {{$monthly_orders}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body ribbon">
                            <a href="#" class="my_sort_cut text-muted">
                                <i class="fas fa-stopwatch"></i>
                                <span>Tiempo Atención (minutos)</span>
                                <span><strong> {{number_format($monthly_oportunity)}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body ribbon">
                            <a href="#" class="my_sort_cut text-muted">
                                <i class="fas fa-tasks"></i>
                                <span>Estudios Pendientes</span>
                                <span><strong> {{$pending_admission}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix row-deck">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estadística Órdenes</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
{{--                            <div id="chart-bar" style="height: 350px"></div>--}}
                            <canvas id="myChart" width="50" height="25">

                            </canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Plugins ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>
    <script>

        var xmlhttp = new XMLHttpRequest();
        var url = '/dashboard/get-yearly-orders';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var report = JSON.parse(this.responseText);
                var months = report.map(function (elem) {
                    return elem.new_date;
                });
                var orders = report.map(function (elem) {
                    return elem.id_count;
                });
                const data = {
                    labels: months,
                    datasets: [{
                        label: 'Número de órdenes por mes',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: orders,
                    }]
                };
                const config = {
                    type: 'line',
                    data,
                    options: {}
                };
                var myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            }
        }
    </script>
{{--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>--}}

{{--    <script>--}}
{{--        $.getJSON('/dashboard/get-yearly-orders', function (data){--}}
{{--            new Morris.Line({--}}
{{--                // ID of the element in which to draw the chart.--}}
{{--                element: 'chart-bar',--}}
{{--                // Chart data records -- each entry in this array corresponds to a point on--}}
{{--                // the chart.--}}
{{--                data: data,--}}
{{--                // The name of the data record attribute that contains x-values.--}}
{{--                xkey: 'new_date',--}}
{{--                // A list of names of data record attributes that contain y-values.--}}
{{--                ykeys: ['id_count'],--}}
{{--                // Labels for the ykeys -- will be displayed when you hover over the--}}
{{--                // chart.--}}
{{--                labels: ['Órdenes']--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endsection


@section('page-script')
    {{-- FontAwesome --}}

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

@endsection
