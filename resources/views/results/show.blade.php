@extends('layouts.layouts')

@section('page-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css"
        integrity="sha512-UrCkMTUH0evgGYJJ1Gb5XGuBXDrsSNoyN6Y6OecnEldtTg0TnqZACVJXyEY1wmvf6H8sKET/Yb85cG1xOjSnsw=="
        crossorigin="anonymous" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item">Atención de Pacientes</li>
            <li class="breadcrumb-item active">Resultados</li>
        </ol>
    </nav>
@endsection


@section('content')

    @php
    $endding = 0;
    $total_op = 0;
    $virtual = 0;
    $printed = 0;
    $os_dets = $admission->serviceorder->serviceorderdetail;
    foreach ($os_dets as $os_det => $opdet) {
        foreach ($opdet->printing as $print ) {
            if ($print->is_printed) {
                $printed +=1;
            }
            if ($print->type == 'Virtual') {
                $virtual = 1;
            }
            $total_op +=1;
        }
    }
    $total_op = $total_op;
    try{
        $progress = ( $printed / $total_op) * 100;
        $progress = number_format( $progress, 0);
    }
    catch(Exception $e){
        $progress = 0.01;
    }
    @endphp
    <div class="section-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h3 class="card-title">{{ $admission->patient->name }}</h3>
                        <div class="clearfix">
                            <div class="float-left"><strong>{{ $progress }}%</strong></div>
                            <div class="float-right"><small class="text-muted">Progreso Impresión</small></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-red" role="progressbar" style="width:{{ $progress }}%"
                                aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">CC / ID</label>
                                    <input type="text" id="docnumero" name="docnumero" class="form-control"
                                        value="{{ $admission->patient->legal_id }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-1">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    <input type="text" class="form-control"
                                        value="{{ Carbon\Carbon::parse($admission->patient->birthday)->age }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Doctor(a) Tratante</label>
                                    <input type="text" name="user_name" class="form-control" name="invoice_date"
                                        value="{{ $admission->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    @if (($admission->delivery == "Virtual" || $admission->delivery == 'Ambas') && $admission->user->name == "GENERICO" )
                                        <label class="form-label">Enviar correo a:</label>
                                            <form action="{{route('user.create_generic', ['id' => $admission->patient->legal_id ])}}"  method="post">
                                                @csrf @method('PUT')
                                                <div class="input-group" {{ $errors->has('user_email') ? 'has-error' : '' }} >
                                                    <input  name="user_email"
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ $generic_user}}">
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary">Actualizar Correo</button>
                                                    </span>
                                                </div>
                                                @if ($generic_user)
                                                    @php
                                                        $endding = 1;
                                                    @endphp
                                                @endif
                                        @elseif (($admission->delivery == "Virtual" || $admission->delivery == 'Ambas') && $admission->user->name != "GENERICO" )
                                                    <label class="form-label">Enviar correo a:</label>
                                                    <form action="{{route('user.update_email', ['id' => $admission->user->id])}}"  method="post">
                                                        @csrf @method('PUT')
                                                        <div class="input-group" {{ $errors->has('user_email') ? 'has-error' : '' }} >
                                                            <input  name="user_email"
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $admission->user->email }}">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-primary">Actualizar!</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                    @php
                                                        if ($admission->user->email){
                                                            $endding = 1;
                                                        }
                                                    @endphp
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('attention.index') }}" class="btn btn-secondary btn-sm ml-2">Dejar Pendiente</a>
                    @if ($admission->delivery == "Virtual" || $admission->delivery == 'Ambas')
                        @if ($endding == 1 && $progress == 100)
                            <a href="{{ route('admission.endding', ['admission' => $admission]) }}"
                                class="btn btn-primary btn-sm">Finalizar Proceso </a>
                        @endif
                    @elseif ($admission->delivery == "Acetato" && $progress == 100)

                        <a href="{{ route('admission.endding', ['admission' => $admission]) }}"
                                class="btn btn-primary btn-sm">Finalizar Proceso </a>
                    @endif

                </div>
            </div>
            <div class="tab-content taskboard">
                <div class="tab-pane fade show active" id="TaskBoard-list" role="tabpanel">
                    <div class="table-responsive">
                        @if ($progress == 100)
                            <div class="alert alert-primary" role="alert">
                                <strong>
                                    <p style="text-align: center"> Todas las órdenes de impresión han sido completadas</p>
                                </strong>
                            </div>
                        @endif

                        <table class="table table-hover table-vcenter mb-0 table_custom spacing8 text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Estudio</th>
                                    <th>Tipo</th>
                                    <th>Impresas</th>
                                    <th>Repetidas</th>
                                    <th>Estado</th>
                                    <th></th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $number = 1
                                @endphp
                                @foreach ($os_details as $order)
                                    @foreach ($order->printing as $print)
                                        @if ($print->type == 'Virtual')
                                            @continue
                                        @endif
                                        <tr>
                                            <td>
                                                {{ $number }}
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $print->serviceorderdetail->product->name }}</h6>

                                            </td>
                                            <td>
                                                {{ $print->type }}
                                            </td>
                                            <td>
                                                <div class="text-info"> {{ $print->printed }} / {{ $print->quanty }} </div>
                                            </td>
                                            <td>
                                                {{ $print->repeated }}

                                            </td>
                                            <td>
                                                @if ($print->printed / $print->quanty != 1)
                                                    <span class="tag tag-rounded tag-yellow">Pendiente</span>
                                                @else
                                                    <span class="tag tag-rounded tag-lime">Completado</span>
                                                @endif
                                            </td>
                                            <td>
                                            </td>
                                            <td class="row justify-content-center">
                                                @if ($print->printed / $print->quanty != 1)
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#exampleModalReal{{ $print->id }}">
                                                        <i   class="icon-printer"></i>&nbsp Impreso</button><br>
                                                    <br>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalReal{{ $print->id }}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST"
                                                                      action="{{ route('results.printonce', ['printing_id' => $print->id]) }}">
                                                                    @csrf @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">Confirmar Impresión</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row clearfix">
                                                                            <div class="col-md-12 col-sm-6">
                                                                                <div class="form-group">
                                                                                    <input type="number"
                                                                                           name="pin"
                                                                                           class="form-control"
                                                                                           placeholder="Pin"
                                                                                           autocomplete="new-password"
                                                                                           min="0" max="9999"
                                                                                           autocomplete="off"
                                                                                           autofocus required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancelar</button>
                                                                        <button
                                                                            class="btn btn-primary">Buscar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                @endif
                                                <form
                                                    action="{{ route('results.printrepeated', ['printing_id' => $print->id]) }}"
                                                    method="post">
                                                    @csrf @method('PUT')
                                                    <button class="btn btn-icon" title="Repetido" data-toggle="tooltip"
                                                        data-placement="top"><i
                                                            class="fa fa-registered text-red"></i></button>
                                                </form>
                                                <button type="button" class="btn btn-icon" title="Editar"
                                                    data-toggle="tooltip" data-placement="top"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-icon "
                                                    title="imprimir con nuevo Insumo" data-toggle="tooltip"
                                                    data-placement="top"><i class="icon-printer"></i></button>
                                                <button type="button" class="btn btn-icon" title="Eliminar"
                                                    data-toggle="tooltip" data-placement="top"><i
                                                        class="icon-trash text-danger"></i></button>
                                            </td>
                                            @php
                                            $number = $number +1
                                            @endphp
                                    @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($virtual == 1)
        <div class="section-body">
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12">
                    {{-- Insert Card Style --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong> ADJUNTAR ESTUDIOS VIRTUALES</strong></h3>
                            <div class="card-options">
                                @if ($virtual == 1)
                                    <button type="button" class="btn btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#exampleModalvirtual{{ $print->id }}">
                                        <i   class="icon-printer"></i>&nbsp Guardar Órdenes Virtuales</button><br>

                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModalvirtual{{ $print->id }}"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST"
                                                      action="{{ route('results.photos.confirm', ['admission' => $admission]) }}">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel">Confirmar Imagen en Portal</h5>
                                                        <button type="button" class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="number"
                                                                           name="pin"
                                                                           class="form-control"
                                                                           placeholder="Pin"
                                                                           autocomplete="new-password"
                                                                           min="0" max="9999"
                                                                           autocomplete="off"
                                                                           autofocus required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                                class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                        <button
                                                            class="btn btn-primary">Buscar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">

                                    @foreach ($os_details as $order)
                                        @foreach ($order->printing as $print)
                                            @if ($print->type == 'Virtual')
                                                <span class="tag tag-azure">{{ $print->serviceorderdetail->product->name}}</span>
                                            @endif
                                            @continue
                                        @endforeach
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="example">
                            <div class="form-group">
                                <label class="form-label">Fotos Adjuntas</label>
                                <p>Haga click sobre la foto para <strong>Eliminar.</strong></p>
                                <div class="row gutters-sm">

                                    @foreach ($admission->photos as $photo)
                                        <div class="col-sm-2">
                                            <form action="{{ route('results.photos.destroy', $photo) }}" method="post">
                                                @csrf @method('DELETE')
                                                <label class="imagecheck mb-4">
                                                    <button class="btn btn-danger btn-xs" style="position:absolute"><i
                                                            class="fa fa-remove"></i>
                                                    </button>
                                                    <figure class="imagecheck-figure">
                                                        <img src="{{ url($photo->url) }}" alt="}"
                                                            class="imagecheck-image" />
                                                    </figure>
                                                </label>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="dropzone"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('before-scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js"
        integrity="sha512-/dI6bSNIeJtFs3HvQbyWFDDqwxBNyTi+VDUIcP3bghK8bsaRjVNVIbrgd5mSrf1oAKP1qe9UIX+hIYzqpD+GTg=="
        crossorigin="anonymous"></script>

    <script>
        var myDropzone = new Dropzone('.dropzone', {
            url: '/attention/order/{{ $admission->id }}/photos',
            /* acceptedFiles: 'image/*',  */
            maxFilesize: 50,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            dictDefaultMessage: "Arrastra las fotos aqui para subirlas"
        });
        Dropzone.autoDiscover = false;

        myDropzone.on('error', function(file, res) {
            var msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

    </script>
@endpush
