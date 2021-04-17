@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb pull-rigth">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{route('admission.index')}}">Admisión</a></li>
            <li class="breadcrumb-item active">Crear</li>
        </ol>
    </nav>
@endsection

@section('content')

<div class="section-body mt-3">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-7 col-md-12">
                <form class="card" method="POST" action="{{ route('admission.store') }}">
                    @csrf
                    <input id="docclase" name="docclase" type="hidden" value="{{ $invoice->docclase }}">
                    <input id="docvende" name="docvende" type="hidden" value="{{ $invoice->docvende }}">

                    <div class="card-body">
                        <h3 class="card-title">DATOS FACTURA</h3>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Tipo</label>
                                    <input  type="text"
                                            id="doctipo"
                                            name="doctipo"
                                            class="form-control"
                                            value="{{ $invoice->doctipo }}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Factura N°</label>
                                    <input  type="text"
                                            id="docnumero"
                                            name="docnumero"
                                            class="form-control"
                                            value="{{ $invoice->docnumero }}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha</label>
                                    <input  type="text"
                                            id="invoice_date"
                                            name="invoice_date"
                                            class="form-control"
                                            value="{{ $invoice->docnewfec}}"
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
                                            value="{{ $invoice->vennombre}}"
                                            readonly>
                                </div>
                            </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">ID Paciente</label>
                                        <input  type="text"
                                                name="patient_id"
                                                class="form-control"
                                                value="{{ $invoice->docvincula}}"
                                                readonly>
                                    </div>
                                </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input  type="text"
                                            name="phone"
                                            class="form-control"
                                            value="{{ $invoice->vintelefon}}"
                                            readonly>
                                </div>
                            </div>
                                @if($invoice->doctipo == 'OS  ')
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">F. Nacimiento</label>
                                            <input  type="text"
                                                    name="birthday"
                                                    class="form-control"
                                                    value="{{ $invoice->vinfnacio}}"
                                                    readonly>
                                        </div>
                                    </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Edad</label>
                                        <input type="text" class="form-control"
                                               value="{{ Carbon\Carbon::parse($invoice->vinfnacio)->age }}"
                                               readonly>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nombre Paciente</label>
                                    <input  type="text"
                                            name="name"
                                            class="form-control"
                                            value="{{ $invoice->vinnombre}}"
                                            readonly>
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
                                                @foreach ($details as $item)
                                                    <tr>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][ordinal]"
                                                                    type="hidden"
                                                                    value="{{ $item->mcnreg }}">
                                                            {{ $item->mcnreg }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][codprod]"
                                                                    type="hidden"
                                                                    value="{{ $item->mcnproduct }}">
                                                            {{ $item->mcnproduct }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][nomprod]"
                                                                    type="hidden"
                                                                    value="{{ $item->pronombre }}">
                                                            {{ $item->pronombre }}
                                                        </th>
                                                        <th>
                                                            <input  name="details[{{$loop->index}}][quanty]"
                                                                    type="hidden"
                                                                    value="{{ $item->mcncantid }}">
                                                            {{ $item->mcncantid }}
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
                        <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">DATOS DE INGRESO</h3>
                                    <div class="col">
                                        @if($invoice->doctipo != 'OS  ')
                                            <div class="form-group">
                                                <label class="form-label">F. Nacimiento Paciente</label>
                                                <input  type="date"
                                                        name="birthday"
                                                        class="form-control"
                                                        value=""
                                                        required>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="form-label">Atención Prioritaria</div>
                                            <label class="custom-switch">
                                                <input type="checkbox"
                                                        name="priority"
                                                        value="1"
                                                        class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Prioritaria</span>
                                            </label>
                                        </div>

                                        <h3 class="form-label">Entrega de Resultados</h3>
                                        <div class="form-group">
                                            <div class="custom-switches-stacked">
                                                <label class="custom-switch">
                                                    <input type="radio" name="option" value="Acetato" class="custom-switch-input" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Acetato</span>
                                                </label>
                                                <label class="custom-switch">
                                                    <input type="radio" name="option" value="Virtual" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Virtual</span>
                                                </label>
                                                <label class="custom-switch">
                                                    <input type="radio" name="option" value="Ambas" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Ambas</span>
                                                </label>
                                                <label class="custom-switch">
                                                    <input type="radio" name="option" value="Papel" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Solo Papel</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                                                    name="observations"
                                                    id="textarea"
                                                    rows="6"
                                                    placeholder=""></textarea>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Ingreso</button>
                                        </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
