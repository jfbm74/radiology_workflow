@extends('layouts.layouts')

@section('after-styles')
    <!-- Plugins css -->
    <!-- Plugins css -->
    <link rel="stylesheet" href="../assets/plugins/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }

    </style>

@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('report.index')}}">Reportes</a> </li>
            <li class="breadcrumb-item">Órdenes</li>
            <li class="breadcrumb-item active">Oportunidad </li>
        </ol>
    </nav>
@endsection


@section('content')

    <h3 class="text-center"> Reporte de Oportunidad de Atención  </h3>
    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('report.opportunity')}}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <label><strong> Fecha Inicial</strong></label>
                                        <div class="input-group">
                                            <input type="date"
                                                   name="date_ini"
                                                   class="form-control"
                                                   placeholder="Fecha Inicio">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <label ><strong> Fecha Final</strong></label>
                                        <div class="input-group">
                                            <input type="date"
                                                   name="date_end"
                                                   class="form-control"
                                                   placeholder="Fecha Final">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                            &nbsp; Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="header-action">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"><i
                                        class="fa fa-file-excel-o"></i>&nbsp; XLS</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="GET"
                                              action="{{route('report.opportunity.csv')}}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Buscar por Fecha</h5>
                                                <button type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-4">
                                                <div class="form-group">
                                                    <label><strong> Fecha Inicial</strong></label>
                                                    <div class="input-group">
                                                        <input type="date"
                                                               name="date_ini"
                                                               class="form-control"
                                                               placeholder="Fecha Inicio">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-4">
                                                <div class="form-group">
                                                    <label ><strong> Fecha Final</strong></label>
                                                    <div class="input-group">
                                                        <input type="date"
                                                               name="date_end"
                                                               class="form-control"
                                                               placeholder="Fecha Final">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                <button class="btn btn-primary">Buscar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($data)
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><strong> Listado de Paciente</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                        <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Factura</strong></th>
                                            <th><strong>Identificación Paciente</strong></th>
                                            <th><strong>Paciente</strong></th>
                                            <th><strong>Prioridad</strong></th>
                                            <th><strong>Fecha Admisión</strong></th>
                                            <th><strong>Tiempo Atención</strong></th>
                                            <th><strong>Num Ordenes Serv</strong></th>
                                            <th><strong>Profesional</strong></th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Factura</strong></th>
                                            <th><strong>Identificación Paciente</strong></th>
                                            <th><strong>Paciente</strong></th>
                                            <th><strong>Prioridad</strong></th>
                                            <th><strong>Fecha Admisión</strong></th>
                                            <th><strong>Tiempo Atención</strong></th>
                                            <th><strong>Num Ordenes Serv</strong></th>
                                            <th><strong>Profesional</strong></th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                           
                                            @foreach($data as $a)
                                                <tr>
                                                        <td>{{$loop->index+1}}</td>
                                                        <td>{{$a->admission->doctype}}-{{$a->admission->invoice_number}}</td>
                                                        <td><span>{{$a->admission->patient->legal_id}}</span></td>
                                                        <td><span>{{$a->admission->patient->name}}</span></td>
                                                        <td><span class="tag tag-default">{{$a->admission->priority}}</span></td>
                                                        <td><span>{{$a->admission_date}}</span></td>
                                                        <td><span>{{$a->attention_time}}</span></td>
                                                        <td><span>{{$a->order_count}}</span></td>
                                                        <td>{{$a->admission->user->name}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

@endsection
@section('before-scripts')

@endsection

@section('page-script')
    <script src="/admin/assets/bundles/dataTables.bundle.js"></script>
    <script src="/admin/assets/js/table/datatable.js"></script>
@endsection
