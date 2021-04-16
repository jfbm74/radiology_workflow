@extends('layouts.layouts')

@section('page-styles')
    <link rel="stylesheet" href="/admin/assets/css/chosen/docsupport/style.css">
    <link rel="stylesheet" href="/admin/assets/css/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="/admin/assets/css/chosen/chosen.css">
@endsection
@section('breadcrumb')
    <nav aria-label="breadcrumb pull-rigth">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item "><a href="{{ route('attention.index') }}">Atención</a></li>
            <li class="breadcrumb-item active">Orden de Servicio</li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-status bg-purple"></div>
                        <div class="card-header">
                            <h3 class="card-title"><strong> {{ $admission->patient->name }}</strong></h3>
                            <div class="card-options">
                                <label class="custom-switch m-0">
                                    @if ($admission->priority == 1)
                                        <span class="tag tag-red mb-3">
                                            Prioritaria</span>
                                    @else
                                        <span class="tag tag-lime mb-3">
                                            Normal</span>
                                    @endif
                                </label>
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                        class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 py-1"><strong>Identificación:</strong></div>
                                <div class="col-7 py-1">{{ $admission->patient->legal_id }}</div>
                                <div class="col-5 py-1"><strong>Edad:</strong></div>
                                <div class="col-7 py-1">{{ Carbon\Carbon::parse($admission->patient->birthday)->age }} Años
                                </div>
                                <div class="col-5 py-1"><strong>Fecha Admisión:</strong></div>
                                <div class="col-7 py-1">{{ $admission->invoice_date }}</div>
                                <div class="col-5 py-1"><strong>Factura N°:</strong></div>
                                <div class="col-7 py-1">{{ $admission->invoice_number }}</div>
                                <div class="col-5 py-1"><strong>Profesional:</strong></div>
                                <div class="col-7 py-1">{{ $admission->user->name }}</div>
                                <div class="col-5 py-1"><strong>Teléfono:</strong></div>
                                <div class="col-7 py-1">{{ $admission->patient->phone }}</div>
                                <div class="col-5 py-1"><strong>Observaciones</strong></div>
                                @if (is_null($admission->obs))
                                    Sin Observaciones
                                @else
                                    <div class="alert alert-danger">{{ $admission->obs }}</div>
                                @endif
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Detalle de factura</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod</th>
                                                            <th>Descripción</th>
                                                            <th>Cant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($admission->billdetail as $detail)
                                                            <tr>
                                                                <th scope="row">{{ $detail->codprod }}</th>
                                                                <td>{{ $detail->desprod }}</td>
                                                                <td>{{ $detail->quanty }}</td>
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
                        <div class="card-footer">
                          </div>
                        </div>

                        <div>

                            <div >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">

                        {{-- Section --}}
                        @include('partials.orderselect')
                        {{-- End Section --}}


                        {{-- Start timeline --}}
                        {{-- @include('partials.timeline') --}}
                        {{-- End Timeline --}}

                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('before-scripts')
        <script src="/admin/assets/js/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="/admin/assets/js/chosen/chosen.jquery.js" type="text/javascript"></script>
        <script src="/admin/assets/js/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
        <script src="/admin/assets/js/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    @endpush
