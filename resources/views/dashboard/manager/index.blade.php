@extends('layouts.layouts')

@section('after-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"
        integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g=="
        crossorigin="anonymous" />
    <!-- Plugins css -->
    <link rel="stylesheet" href="/admin/assets/plugins/charts-c3/c3.min.css"/>

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
                            <div id="chart-bar" style="height: 350px"></div>
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
@endsection



@section('page-script')


    <script src="/admin/assets/bundles/lib.vendor.bundle.js"></script>
    <script src="/admin/assets/bundles/apexcharts.bundle.js"></script>
    <script src="/admin/assets/bundles/counterup.bundle.js"></script>
    <script src="/admin/assets/bundles/knobjs.bundle.js"></script>
    <script src="/admin/assets/bundles/c3.bundle.js"></script>
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


    <script>

        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30,40,35,50,49,60,70,91,125]
            }],
            xaxis: {
                categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart-bar"), options);
        chart.render();
    </script>
@endsection
