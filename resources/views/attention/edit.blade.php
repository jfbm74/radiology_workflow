@extends('layouts.layouts')

@section('page-styles')

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />

@endsection


@section('breadcrumb')
    <nav aria-label="breadcrumb pull-rigth">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{ route('admission.index') }}">Admisión</a></li>
            <li class="breadcrumb-item active">Crear</li>
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

                        <div class="card-header">
                            <h3 class="card-title">DATOS FACTURA</h3>
                            
                        </div>
                        
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Factura N°</label>
                                        <input type="text" id="docnumero" name="docnumero" class="form-control"
                                            value="{{ $admission->invoice_number }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Fecha Factura</label>
                                        <input type="text" id="invoice_date" name="invoice_date" class="form-control"
                                            value="{{ $admission->invoice_date }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Médico Tratante</label>
                                        <select id="mltislct" name="user_id">
                                            @foreach ($users as $user)
                                                <option value=" {{ $user->id }}" @if ($admission->user_id == $user->id)
                                                    selected>{{ $user->name }}</option>
                                            @endif
                                            >{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">ID Paciente</label>
                                        <input type="text" name="patient_id" class="form-control"
                                            value="{{ $admission->patient->legal_id }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">F. Nacimiento</label>
                                        <input type="text" name="birthday" class="form-control"
                                            value="{{ $admission->patient->birthday }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Edad</label>
                                        <input type="text" class="form-control"
                                            value="{{ Carbon\Carbon::parse($admission->patient->birthday)->age }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nombre Paciente</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $admission->patient->name }}">
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
                                                {{-- {{ dd($admission->billdetail) }}
                                                --}}
                                                @foreach ($admission->billdetail as $item)
                                                    <tr>
                                                        <th>
                                                            <input name="details[{{ $loop->index }}][ordinal]" type="hidden"
                                                                value="{{ $item->ordinal }}">
                                                            {{ $item->ordinal }}
                                                        </th>
                                                        <th>
                                                            <input name="details[{{ $loop->index }}][codprod]" type="hidden"
                                                                value="{{ $item->codprod }}">
                                                            {{ $item->codprod }}
                                                        </th>
                                                        <th>
                                                            <input name="details[{{ $loop->index }}][nomprod]" type="hidden"
                                                                value="{{ $item->desprod }}">
                                                            {{ $item->desprod }}
                                                        </th>
                                                        <th>
                                                            <input name="details[{{ $loop->index }}][quanty]" type="hidden"
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
          {{-- Section --}}
          @include('partials.edit_printcontrol')
          {{-- End Section --}}


    </div>

@endsection

@push('before-scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        var shiftClick = jQuery.Event("click");
        shiftClick.shiftKey = true;
        $(document).ready(function() {
            $('#mltislct').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '300px',
                maxHeight: 300,
                filterPlaceholder: 'Buscar...'
            });
        });

    </script>

@endpush

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js">
    </script>
@endpush
