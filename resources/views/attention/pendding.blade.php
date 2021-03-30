@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item ">Atención de Pacientes</li>
            <li class="breadcrumb-item active">Pacientes Pendientes</li>
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
                <div class="tab-pane fade show active" id="Employee-list" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong> Lista Pacientes pendientes de resultado</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th>Órdenes</th>
                                            <th>Acciones</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $admission)
                                            <tr>
                                                <td class="w40">
                                                    <span>{{$loop->index + 1}}</span>
                                                </td>
                                                <td class="d-flex">
                                                    <div class="ml-3">
                                                        <h6 class="mb-0">{{ $admission->patient->name }}</h6>
                                                        <span class="text-muted"><strong>ID:</strong>
                                                            {{ $admission->patient->legal_id }}  <strong>FA/OS:</strong> {{ $admission->doctype}}-{{ $admission->invoice_number}} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span>{{ Carbon\Carbon::parse($admission->invoice_date)->diffForHumans() }}</span>
                                                </td>

                                                <td>
                                                    <div class="tags">
                                                        @foreach ($admission->serviceorder->serviceorderdetail as $detail)
                                                            <span class="tag tag-rounded">{{ $detail->desprod }}</span><br>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>

                                                    <form action="{{ route('printing.show', ['admission_id' => $admission->id]) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-primary" type="submit"><i class="icon-printer"> Imprimir</i></button>


                                                    </form>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-icon btn-sm" title="View"><i
                                                            class="fa fa-eye"></i></button>
                                                    <a href="{{route('order.edit', $admission)}}" class="btn btn-icon btn-sm"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('admission.destroy', $admission)}}" class="btn btn-icon btn-sm js-sweetalert"
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
