@extends('layouts.layouts')

@section('after-styles')
    <!-- Plugins css -->
    <!-- Plugins css -->
    <link rel="stylesheet" href="../assets/plugins/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }

    </style>

@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item ">Administración</li>
            <li class="breadcrumb-item active">Ingresos</li>

        </ol>
    </nav>
@endsection

@section('content')

    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong> Listado de Ingresos</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Fecha</strong></th>
                                            <th><strong>Factura</strong></th>
                                            <th><strong>Paciente</strong></th>
                                            <th><strong>Órdenes</strong></th>
                                            <th><strong>Acciones</strong></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Fecha</strong></th>
                                            <th><strong>Factura</strong></th>
                                            <th><strong>Paciente</strong></th>
                                            <th><strong>Órdenes</strong></th>
                                            <th><strong>Acciones</strong></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                            @foreach ($admissions as $admission)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td>{{ $admission->invoice_date}}</td>
                                                    <td>{{ $admission->invoice_number}}</td>
                                                    <td>{{ $admission->patient->name}}</td>
                                                    <td>
                                                        @if(empty($admission->serviceorder->serviceorderdetail))
                                                            Órdenes sin confirmar
                                                        @else
                                                            @foreach ( $admission->serviceorder->serviceorderdetail as $item)
                                                                <span class="tag">{{$item->product->name}}</span>
                                                            @endforeach
                                                        @endif

                                                    </td>
                                                    <td class="actions">
                                                        <a href="{{ route('admission.show', ['id' => $admission->id])}}}" ><i class="fa fa-eye mr-2"
                                                            data-toggle="tooltip" data-original-title="Consultar"></i></a>
                                                        <button class="btn btn-sm btn-icon on-default m-r-5 button-edit"
                                                            data-toggle="tooltip" data-original-title="Editar"><i
                                                                class="icon-pencil" aria-hidden="true"></i></button>
                                                        <button class="btn btn-sm btn-icon on-default m-r-5 button-edit"
                                                            data-toggle="tooltip" data-original-title="Reenviar Correo"><i
                                                                class="icon-envelope" aria-hidden="true"></i></button>
                                                                <a  onclick="return confirm('¿Está seguro(a) eliminar este registro? Esta operación no se puede deshacer.')"
                                                                href="{{route('admission.destroy', $admission)}}" class="btn btn-icon btn-sm js-sweetalert"
                                                                    title="Delete" data-type="confirm"><i
                                                                        class="fa fa-trash-o text-danger"></i></a>
                                                    </td>
                                            @endforeach
                                            </tr>
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
    <script src="/admin/assets/bundles/dataTables.bundle.js"></script>
    <script src="/admin/assets/js/table/datatable.js"></script>
@endsection
