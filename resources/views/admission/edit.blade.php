@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb pull-rigth">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{route('admission.index')}}">Admisión</a></li>
            <li class="breadcrumb-item active">Actualizar</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-7 col-md-12">
                <form class="card" method="POST" action="{{ route('admission.update', $admission) }}">
                    @csrf @method('PUT')
                    <input id="doctype" name="doctype" type="hidden" value="{{ $admission->doctype }}">
                    <input id="docvende" name="docvende" type="hidden" value="{{ $admission->user_id }}">

                    <div class="card-body">
                        <h3 class="card-title">DATOS FACTURA</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Factura N°</label>
                                    <input  type="text"
                                            id="docnumero"
                                            name="docnumero"
                                            class="form-control"
                                            value="{{ $admission->invoice_number }}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha Factura</label>
                                    <input  type="text"
                                            id="invoice_date"
                                            name="invoice_date"
                                            class="form-control"
                                            value="{{ $admission->invoice_date}}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Médico Tratante</label>
                                    <input  type="text"
                                            name="user_name"
                                            class="form-control"
                                            name="invoice_date"
                                            value="{{ $admission->user->name}}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">ID Paciente</label>
                                    <input  type="text"
                                            name="patient_id"
                                            class="form-control"
                                            value="{{ $admission->patient->legal_id}}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">F. Teléfono</label>
                                    <input  type="text"
                                            name="phone"
                                            class="form-control"
                                            value="{{ $admission->patient->phone}}"
                                            >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">F. Nacimiento</label>
                                    <input  type="date"
                                            name="birthday"
                                            class="form-control"
                                            value="{{ $admission->patient->birthday}}"
                                            >
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    <input type="text" class="form-control"
                                            value="{{ Carbon\Carbon::parse($admission->patient->birthday)->age }}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nombre Paciente</label>
                                    <input  type="text"
                                            name="name"
                                            class="form-control"
                                            value="{{ $admission->patient->name}}"
                                            >
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>CODIGO</th>
                                                    <th>DESCRIPCIÓN</th>
                                                    <th>CANTIDAD</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{dd($admission->billdetail )}} --}}
                                                @foreach ($admission->billdetail as $item)
                                                    <tr>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][ordinal]"
                                                                    type="hidden"
                                                                    value="{{ $item->ordinal }}">
                                                            {{ $item->ordinal }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][codprod]"
                                                                    type="hidden"
                                                                    value="{{ $item->codprod }}">
                                                            {{ $item->codprod }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][nomprod]"
                                                                    type="hidden"
                                                                    value="{{ $item->desprod }}">
                                                            {{ $item->desprod }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][quanty]"
                                                                    type="hidden"
                                                                    value="{{ $item->quanty }}">
                                                            {{ $item->quanty }}
                                                        </th>
                                                    </tr>
                                                @endforeach

                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-5 col-md-12">
                {{-- Admission Form Starts Here --}}
                @include('admission.partials.admission_form')
                {{-- End Admission Form --}}
            </div>
        </div>
    </div>
</div>

@endsection
