@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item active">Atención de Pacientes</li>
        </ol>
    </nav>
@endsection


@section('content')


    {{-- Start Stats --}}
    @include('attention.partials.stats')
    {{-- End Stats --}}

    <div class="section-body">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade show active">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong> Lista Pacientes En Atención</strong></h3>
                            <div class="card-options">
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tiempo</th>
                                            <th>Paciente</th>
                                            <th>Cumplir Órdenes</th>
                                            <th>Acciones</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $admission)
                                            {{-- AGE Order --}}
                                            <tr>
                                                <td class="w40">
                                                    <div class="row">
                                                        <span>{{ Carbon\Carbon::parse($admission->invoice_date)->diffForHumans() }}</span>
                                                        <span>
                                                            @if ($admission->priority == '5')
                                                                <span class="tag tag-green"> Normal </span>
                                                            @else
                                                                <span class="tag tag-red">Prioritaria</span>
                                                            @endif
                                                        </span>

                                                </td>
                                                {{-- Patient Name --}}
                                                <td class="d-flex">
                                                    <div class="ml-3">
                                                        <h6 class="mb-0">{{ $admission->patient->name }}</h6>
                                                        <span class="text-muted">ID:
                                                            {{ $admission->patient->legal_id }}</span><br>

                                                        <div class="clearfix">

                                                            @php
                                                            $servicedetails = $admission->serviceorder;
                                                            $totalorders = $servicedetails->serviceorderdetail->count();
                                                            $orders_tmp = $servicedetails->serviceorderdetail;
                                                            $fullfil = 0;
                                                            foreach ( $orders_tmp as $key => $value) {
                                                            if ($value->status == 'cumplido') {
                                                            $fullfil += 1;
                                                            }
                                                            }
                                                            $progress = ($fullfil / $totalorders) * 100;
                                                            $progress = number_format( $progress, 0);
                                                            @endphp
                                                            <div class="float-left"><strong>{{ $progress }}%</strong></div>
                                                            <div class="float-right"><small
                                                                    class="text-muted">Progreso</small></div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-red" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- Order Fullfilment --}}
                                                <td>
                                                    <div class="tags">
                                                        @foreach ($admission->serviceorder->serviceorderdetail as $order)

                                                            @if ($order->status == 'nuevo')
                                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#exampleModal{{ $order->id }}">
                                                                    <i
                                                                        class="fa fa-check-square-o"></i>&nbsp;{{ $order->name }}</button><br>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal{{ $order->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <form method="POST"
                                                                                action="{{ route('order.fullfilment', ['orderservicedetail' => $order->id]) }}">
                                                                                @csrf @method('PUT')
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">Pin
                                                                                        Personal</h5>
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
                                                                <button type="button"
                                                                    class="btn btn-outline-success btn-sm">{{ $order->name }}</button><br>
                                                            @endif


                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                {{-- Actions --}}
                                                    {{-- Fullfilment with 100% Order Accomplished --}}
                                                    @if ($progress == 100)
                                                        <div class="header-action">
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#exampleModal100{{ $admission->id }}"><i
                                                                    class="fa fa-check-square-o"></i>&nbsp;
                                                                Finalizar</button>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal100{{ $admission->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form method="POST"
                                                                        action="{{ route('order.complete', ['admission' => $admission->id]) }}">
                                                                        @csrf @method('PUT')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                Pin
                                                                                Personal</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row clearfix">
                                                                                <div class="col-md-12 col-sm-6">

                                                                                    <div class="form-group">
                                                                                        <input type="number" name="pin"
                                                                                            class="form-control"
                                                                                            placeholder="Pin"
                                                                                            autocomplete="new-password"
                                                                                            min="0" max="9999"
                                                                                            autocomplete="off" autofocus
                                                                                            required>

                                                                                    </div>
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
                                                        
                                                    @else
                                                        <div class="header-action">
                                                            <button class="btn btn-outline-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#exampleModal{{ $admission->id }}">
                                                                <i class="fa fa-warning"></i>
                                                                &nbsp; Finalizar
                                                            </button>
                                                        </div>
                                                    @endif

                                                    {{-- Script Warning Remains Orders --}}
                                                    <div class="modal fade" id="exampleModal{{ $admission->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST"
                                                                    action="{{ route('order.complete', ['admission' => $admission->id]) }}">
                                                                    @csrf @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Pin
                                                                            Personal</h5>
                                                                        <button
                                                                            onclick="return confirm('Hay órdenes pendientes por cumplir, ¿Está seguro(a) de darles cumplimiento a las faltantes?')"
                                                                            class="close" type="button" data-dismiss="modal"
                                                                            aria-label="Close"><span
                                                                                aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row clearfix">
                                                                            <div class="col-md-12 col-sm-6">

                                                                                <div class="form-group">
                                                                                    <input type="number" name="pin"
                                                                                        class="form-control"
                                                                                        placeholder="Pin"
                                                                                        autocomplete="new-password" min="0"
                                                                                        max="9999" autocomplete="off"
                                                                                        autofocus required>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                        <button
                                                                            onclick="return confirm('Hay órdenes pendientes por cumplir, ¿Está seguro(a) de darles cumplimiento a las faltantes?')"
                                                                            class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-icon btn-sm" title="View"><i
                                                            class="fa fa-eye"></i></button>
                                                    <a href="{{route('order.edit', $admission)}}" class="btn btn-icon btn-sm" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                    <a  onclick="return confirm('¿Está seguro(a) eliminar este registro? Esta operación no se puede deshacer.')"
                                                    href="{{route('admission.destroy', $admission)}}" class="btn btn-icon btn-sm js-sweetalert"
                                                        title="Delete" data-type="confirm"><i
                                                            class="fa fa-trash-o text-danger"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Employee-view" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Employee-Request" role="tabpanel">

                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('order.create') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pin Personal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-6">

                                <div class="form-group">
                                    <input type="password" name="pin" class="form-control" placeholder="Pin"
                                        autocomplete="new-password">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
