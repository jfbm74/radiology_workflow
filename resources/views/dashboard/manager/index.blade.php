@extends('layouts.layouts')

@section('after-styles')
    <!-- Plugins css -->
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">--}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"
        integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g=="
        crossorigin="anonymous" />

@endsection

@section('content')

    <div class="section-body mt-3 ">
        <!-- Data Widgets -->
        <div class="container-fluid ">
            <div class="row clearfix">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4>Bienvenido, {{ Auth()->user()->name }}</h4>
                            <small><a href="#"></a></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-4 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body ribbon">
                            <a href="{{route('admission.list')}}" class="my_sort_cut text-muted">
                                <i class="icon-users"></i>
                                <span>Pacientes <small>(30 días)</small></span>
                                <span><strong> {{$monthly_patients}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('report.productivity.detail')}}" class="my_sort_cut text-muted">
                                <i class="fa fa-paste"></i>
                                <span>Órdenes <small>(30 días)</small></span>
                                <span><strong> {{$monthly_orders}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-xl-2">
                    <div class="card">
                        <div class="card-body ribbon">
                            <a href="{{route('report.opportunity')}}" class="my_sort_cut text-muted">
                                <i class="fas fa-stopwatch"></i>
                                <span>Tiempo <small>(30 días)</small></span>
                                <span>
                                    @if(is_numeric($monthly_oportunity))
                                        <strong>  {{number_format($monthly_oportunity)}}  </strong>
                                    @else
                                        <strong> 0 </strong>
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-xl-2">
                    <div class="card style=">
                        <div class="card-body ribbon">
                            <div class="ribbon-box pink">{{$pending_older_admission}}</div>
                            <a href="{{route('results.pendding')}}" class="my_sort_cut text-muted">
                                <i class="fas fa-calendar-times"  ></i>
                                <span>Pendientes </span>
                                <span><strong> {{$pending_admission}}</strong></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data ChartsJS -->
    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix row-deck">
                <!-- Yearly Orders ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estadística Órdenes Anual</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="Orders-chart" height="100"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Yearly Opportunity ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estadística Oportunidad Anual</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="time-chart" height="100"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix row-deck">
                <!-- Monthly Product ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estadística Producto (30 días)</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="product_chart" height="200"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Monthly Package ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estadística Paquetes (30 días)</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="package_chart"  height="200"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix row-deck">
                <!-- Monthly Professionals ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Órdenes por Profesional (30 días)</h3>
                            <div class="card-options">

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="professionals_products_chart"  height="400"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Monthly Technician ChartJS -->
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Órdenes por Técnico (30 días)</h3>
                            <div class="card-options">
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="tecnician_orders_chart"  width="100"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-sm w200 mr-3">Generar Reporte</a>--}}
                                <small>Nota: </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Plugins ChartJS -->
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"
            integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A=="
            crossorigin="anonymous">
    </script>

    <!-- Orders ChartJS -->
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
                        backgroundColor: 'rgb(59,49,79)',
                        borderColor: 'rgb(59,49,79)',
                        data: orders,
                    }]
                };
                const config = {
                    type: 'line',
                    data,
                    options: {}
                };
                var myChart = new Chart(
                    document.getElementById('Orders-chart'),
                    config
                );
            }
        }
    </script>
    <!-- Opportunity ChartJS -->
    <script>
        var xmlhttp = new XMLHttpRequest();
        var url = '/dashboard/get-yearly-opportunity';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var opp_data = JSON.parse(this.responseText);
                var monthly = opp_data.map(function (elem) {
                    return elem.month;
                });
                var avgs = opp_data.map(function (elem) {
                    return elem.avg_month;
                });
                const data = {
                    labels: monthly,
                    datasets: [{
                        label: 'Oportunidad de la Atención por Mes',
                        backgroundColor: 'rgb(39,130,61)',
                        borderColor: 'rgb(39,130,61)',
                        data: avgs,
                    }]
                };
                const config = {
                    type: 'line',
                    data,
                    options: {}
                };
                var timeChart = new Chart(
                    document.getElementById('time-chart'),
                    config
                );
            }
        }
    </script>
    <!-- Product ChartJS -->
    <script>
        var xmlhttp = new XMLHttpRequest();
        var url = '/dashboard/get-monthly-products';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var prods_data = JSON.parse(this.responseText);
                var product = prods_data.map(function (elem) {
                    return elem.name;
                });
                var quantity = prods_data.map(function (elem) {
                    return elem.id_count;
                });

                const data = {
                    labels: product,
                    datasets: [{
                        label: 'Productos por Mes',
                        backgroundColor: 'rgb(59,49,79)',
                        borderColor: 'rgb(59,49,79)',
                        data: quantity
                    }]
                };
                const config = {
                    type: 'bar',
                    data,
                    options: {
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                    }
                };
                var productchart = new Chart(
                    document.getElementById('product_chart'),
                    config
                );

            }
        }
    </script>
    <!-- Package ChartJS -->
    <script>
        var xmlhttp = new XMLHttpRequest();

        var url = '/dashboard/get-monthly-packages';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var packs_data = JSON.parse(this.responseText);
                var pack = packs_data.map(function (elem) {
                    return elem.cod_manager;
                });
                var quantity = packs_data.map(function (elem) {
                    return elem.product_count;
                });

                const data = {
                    labels: pack,
                    datasets: [{
                        label: 'Productos por Mes',
                        backgroundColor: 'rgb(39,130,61)',
                        borderColor: 'rgb(39,130,61)',
                        data: quantity
                    }]
                };
                const config = {
                    type: 'bar',
                    data,
                    options: {
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                    }
                };
                var packagechart = new Chart(
                    document.getElementById('package_chart'),
                    config
                );

            }
        }


    </script>
    <!-- Professionals ChartJS -->
    <script>
        var xmlhttp = new XMLHttpRequest();

        var url = '/dashboard/get-monthly-professionals';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var pros_data = JSON.parse(this.responseText);
                var professional = pros_data.map(function (elem) {
                    return elem.name;
                });
                var quantity = pros_data.map(function (elem) {
                    return elem.product_count;
                });

                const data = {
                    labels: professional,
                    datasets: [{
                        label: 'Productos por Mes',
                        backgroundColor: 'rgb(59,49,79)',
                        borderColor: 'rgb(59,49,79)',
                        data: quantity
                    }]
                };
                const config = {
                    type: 'bar',
                    data,
                    options: {
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                    }
                };
                var professionalsproductschart = new Chart(
                    document.getElementById('professionals_products_chart'),
                    config
                );

            }
        }


    </script>
    <!-- Technician ChartJS -->
    <script>

        var xmlhttp = new XMLHttpRequest();
        var url = '/dashboard/get-monthly-technicians';
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var tech_data = JSON.parse(this.responseText);
                var technician = tech_data.map(function (elem) {
                    return elem.name;
                });
                var quantity = tech_data.map(function (elem) {
                    return elem.product_count;
                });

                const num_tech = technician.length;

                const data = {
                    labels: technician,
                    datasets: [
                        {
                            label: 'Dataset 1',
                            data: quantity,
                            backgroundColor: [
                                'rgb(236,120,167)',
                                'rgb(23,57,10)',
                                'rgb(114,110,8)',
                                'rgb(68,15,175)',
                                'rgb(164,43,173)',
                                'rgb(226,10,79)',
                            ]
                        }
                    ]
                };
                const config = {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio : false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Cumplimiento de órdenes por Técnico'
                            }
                        }
                    },
                };
                var tecnicianorderschart = new Chart(
                    document.getElementById('tecnician_orders_chart'),
                    config
                );
            }
        }
    </script>

@endsection


@section('page-script')
    {{-- FontAwesome --}}

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

@endsection
