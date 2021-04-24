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
                                    <h5 class="m-0">{{ $patient->name }}</h5>
                                    <p class="text-muted mb-0">Paciente</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">ID: </small>
                            <p class="mb-0">{{ $patient->legal_id }}</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Fecha Nacimiento: </small>
                            <p class="mb-0">{{ $patient->birthday }}</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Edad: </small>
                            <p class="mb-0">{{ Carbon\Carbon::parse($patient->birthday)->age }} Años</p>
                        </li>
                        <li class="list-group-item">
                            <small class="text-muted">Email: </small>
                            <p class="mb-0">{{ $patient->email ?? 'Sin Registrar' }}</p>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong></strong> Consultar Imágenes</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Imágenes</th>
                                            <th>Estudios</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->admission as $adm)
                                            @if ($adm->delivery == "Virtual" | $adm->delivery == "Ambas")
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $adm->invoice_date }}</td>
                                                    <td>
                                                        @foreach ($adm->serviceorder->serviceorderdetail as $order)
                                                            <span class="tag tag-gray">{{$order->product->name}}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('patient.gallery', ['admission' => $adm]) }}"
                                                            class="btn btn-success"><i class="fe fe-check mr-2"></i>Ver</a>
{{--                                                        <input type="text" value="http://127.0.0.1:8000/storage/image-000001.dcm" id="myInput">--}}
{{--                                                        <button onclick="myFunction()">DICOM</button>--}}

{{--                                                        <script>--}}
{{--                                                            function myFunction() {--}}
{{--                                                                var copyText = document.getElementById("myInput");--}}
{{--                                                                copyText.select();--}}
{{--                                                                copyText.setSelectionRange(0, 99999)--}}
{{--                                                                document.execCommand("copy");--}}
{{--                                                                window.open('http://localhost:3000/u-dicom-viewer/', '_blank');--}}
{{--                                                                window.location.href = '';--}}
{{--                                                            }--}}
{{--                                                        </script>--}}
                                                    </td>
                                                    <td><a href="#" class="btn btn-dark"><i
                                                                class="fe fe-download mr-2"></i>Descargar</a></td>
                                                </tr>
                                            @endif
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

@endsection

@section('before-scripts')

@endsection

@section('page-script')

@endsection
