@extends('layouts.layouts')

@section('after-styles')


@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item active">Paciente</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <div class="media mb-0">
                                <img class="rounded mr-3" src="" alt="">
                                <div class="media-body">
                                    <h5 class="m-0">{{ $id->patient->name }}</h5>
                                    <p class="text-muted mb-0">Paciente</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">ID: </small>
                            <p class="mb-0">{{ $id->patient->legal_id }}</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Fecha Nacimiento: </small>
                            <p class="mb-0">{{ $id->patient->birthday }}</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Edad: </small>
                            <p class="mb-0">{{ Carbon\Carbon::parse($id->patient->birthday)->age }} Años</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Email: </small>
                            <p class="mb-0">{{ $id->patient->email ?? 'Sin Registrar' }}</p>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong></strong> Datos del Ingreso</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6>Informacion Oportunidad</h6>
                            <div class="row">
                                <div class="col-5 py-1"><strong>Admision N°:</strong></div>
                                <div class="col-7 py-1">{{$id->id }}</div>
                                <div class="col-5 py-1"><strong>Fecha Ingreso:</strong></div>
                                <div class="col-7 py-1">{{$id->invoice_date }}</div>
                                <div class="col-5 py-1"><strong>Tipo Entrega:</strong></div>
                                <div class="col-7 py-1">{{$id->delivery}}</div>
                                <div class="col-5 py-1"><strong>Estado:</strong></div>
                                <div class="col-7 py-1">{{$id->status}}</div>
                                <div class="col-5 py-1"><strong>Usuario Admisión:</strong></div>
                                <div class="col-7 py-1">
                                    @if(empty($id->serviceorder->user->name))
                                    @else
                                        {{$id->serviceorder->user->name}}
                                    @endif


                                </div>
                                <div class="col-5 py-1"><strong>Profesional:</strong></div>
                                <div class="col-7 py-1">{{$id->user->name}}</div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Detalle de Oŕdenes</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Orden</th>
                                                            <th>Fecha Cumplimiento</th>
                                                            <th>Hecho por</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(empty($id->serviceorder->serviceorderdetail))
                                                    @else
                                                      @foreach ($id->serviceorder->serviceorderdetail as $order)
                                                        <tr>
                                                            <th scope="row">{{$order->id}}</th>
                                                            <td>{{$order->name}}</td>
                                                            <td>{{$order->fullfilment_date}}</td>
                                                            <td>{{$order->user->name}}</td>
                                                        </tr>
                                                      @endforeach
                                                    @endif



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6>Informacion Oportunidad</h6>


                            <div class="row">
                                @if(empty($id->serviceorder->serviceorderdetail))
                                @else
                                    <div class="col-5 py-1"><strong>Fecha Admisión</strong></div>
                                    <div class="col-7 py-1">{{$id->invoice_date}}</div>
                                    <div class="col-5 py-1"><strong>Tiempo Espera (min):</strong></div>
                                    <div class="col-7 py-1">{{ $statistics->waiting_time }}</div>
                                    <div class="col-5 py-1"><strong>Tipo Atención (min):</strong></div>
                                    <div class="col-7 py-1">{{$statistics->attention_time}}</div>
                                    <div class="col-5 py-1"><strong>Tiempo Resultados:</strong></div>
                                    <div class="col-7 py-1">{{$statistics->finish_time}}</div>
                                    <div class="col-5 py-1"><strong>Usuario Admisión:</strong></div>
                                    <div class="col-7 py-1">{{$id->serviceorder->user->name}}</div>
                                    <div class="col-5 py-1"><strong>Profesional:</strong></div>
                                    <div class="col-7 py-1">{{$id->user->name}}</div>
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('before-scripts')

@endsection

@section('page-script')

@endsection
