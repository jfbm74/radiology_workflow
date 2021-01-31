@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item">Admisión</li>
            <li class="breadcrumb-item active">Pacientes en Espera</li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <ul class="nav nav-tabs page-header-tab">
                </ul>
                <div class="header-action">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="fe fe-plus mr-2"></i>Ingreso</button>
                </div>
            </div>
            {{-- Start Stats --}}
            @include('admission.partials.stats')
            {{-- End Stats --}}

        </div>
    </div>
    <div class="section-body">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="Employee-list" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <strong> Lista Pacientes en Espera</strong></h3>
                            <div class="card-options">
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>CC / ID</th>
                                            <th>Fecha / Hora</th>
                                            <th>Tiempo Espera</th>
                                            <th>Prioridad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $admission)
                                            <tr>
                                                <td class="w40">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="d-flex">
                                                    <div class="ml-3">
                                                        <h6 class="mb-0">{{ $admission->patient->name }}</h6>
                                                        <span class="text-muted">N° Fact: <strong>
                                                                {{ $admission->invoice_number }}</strong></span>
                                                    </div>
                                                </td>
                                                <td><span> {{ $admission->patient->legal_id }}</span></td>
                                                <td><span>{{ $admission->invoice_date }}</span></td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($admission->invoice_date)->diffForHumans() }}
                                                </td>
                                                <td>
                                                    @if ($admission->priority == '5')
                                                        <span class="tag tag-green"> Normal </span>
                                                    @else
                                                        <span class="tag tag-red">Prioritaria</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-icon btn-sm" title="View"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a href="{{route('admission.edit', $admission)}}" class="btn btn-icon btn-sm" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a  onclick="return confirm('¿Está seguro(a) eliminar este registro? Esta operación no se puede deshacer.')"
                                                        href="{{route('admission.destroy', $admission)}}" 
                                                        type="button" 
                                                        class="btn btn-icon btn-sm js-sweetalert"
                                                        title="Delete" 
                                                        data-type="confirm"><i
                                                        class="fa fa-trash-o text-danger"></i>
                                                    </a>
                                                </td>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('bill.search') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buscar Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-6">

                                <div class="form-group">
                                    <input type="number" name="invoice" class="form-control" placeholder="N° Factura">
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

@push('scripts')
    <script>
        if (window.location.hash === '#create') {
            $('#exampleModal').modal('show');
        }

        $('#exampleModal').on('hide.bs.modal', function() {
            window.location.hash = '#';
        });

        $('#exampleModal').on('shown.bs.modal', function() {
            $('#post-title').focus();
            window.location.hash = '#create';
        });

    </script>
@endpush
