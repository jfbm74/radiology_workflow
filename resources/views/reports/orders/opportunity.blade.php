@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item">Reportes</li>
            <li class="breadcrumb-item">Órdenes</li>
            <li class="breadcrumb-item active">Oportunidad </li>
        </ol>
    </nav>
@endsection


@section('content')

    <h1> Reporte de Oportunidad de Atención</h1>
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
                                        <div class="input-group">
                                            <div class="form-group">
                                                <select class="form-control show-tick"
                                                        name="technician">
                                                    <option></option>
                                                    @foreach($staff as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <div class="input-group">
                                            <input type="date"
                                                   name="date_ini"
                                                   class="form-control"
                                                   placeholder="Fecha Inicio">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-6">
                                        <div class="input-group">
                                            <input type="date"
                                                   name="date_end"
                                                   class="form-control"
                                                   placeholder="Fecha Final">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                            &nbsp; Buscar
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @isset($data)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="#" class="btn btn-primary"><i class="fa fa-file-excel-o">&nbsp; CSV</i></a>
                                &nbsp
                                <a href="#" class="btn btn-primary"><i class="fa fa-file-pdf-o">&nbsp; PDF</i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Detalle</th>
                                            <th colspan="3">Tiempo Promedio</th>
                                        </tr>
                                        <tr class="bg-gray">
                                            <th class="w30">#</th>
                                            <th>Factura</th>
                                            <th>Nombre Paciente</th>
                                            <th>Prioridad</th>
                                            <th>Fecha Admisión</th>
                                            <th>Tiempo (m)</th>
                                            <th>Técnico</th>
                                            <th>Médico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $a)
                                        <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$a->admission->doctype}}-{{$a->admission->invoice_number}}</td>
                                                <td><span>{{$a->admission->patient->name}}</span></td>
                                                <td><span class="tag tag-default">{{$a->admission->priority}}</span></td>
                                                <td><span>{{$a->admission_date}}</span></td>
                                                <td><span>{{$a->attention_time}}</span></td>
                                                <td><span>{{$a->user->name}}</span></td>
                                                <td>{{$a->admission->user->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
