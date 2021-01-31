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
            <li class="breadcrumb-item active">Pacientes</li>
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
                            <h3 class="card-title"><strong> Listado de Paciente</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table table-hover js-basic-example dataTable table_custom border-style spacing5">
                                    <thead>
                                        <tr>
                                            <th><strong>Nombre</strong></th>
                                            <th><strong>ID</strong></th>
                                            <th><strong>ültima actualización</strong></th>
                                            <th><strong>Profesional</strong></th>
                                            <th><strong>Acciones</strong></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><strong>Nombre</strong></th>
                                            <th><strong>ID</strong></th>
                                            <th><strong>ültima actualización</strong></th>
                                            <th><strong>Profesional</strong></th>
                                            <th><strong>Acciones</strong></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            <tr>
                                                <td>{{$patient->name}}</td>
                                                <td>{{$patient->legal_id}}</td>
                                                <td>{{$patient->updated_at}}</td>
                                                <td>
                                                    @foreach ($patient->users as $doctor)
                                                    <div class="tags">
                                                        <span class="tag tag-azure">{{$doctor->name}}</span>
                                                    </div>
                                                    @endforeach
                                                </td>
                                                <td class="actions">
                                                    <a  href="{{route('patient.show', ['id' => $patient->id])}}" class="btn btn-success"><i class="fa fa-file-excel-o mr-2" data-original-title="Consultar Imágenes"></i>Imágenes</a>
                                                    <button class="btn btn-sm btn-icon on-default m-r-5 button-edit"
                                                        data-toggle="tooltip" data-original-title="Editar"><i
                                                            class="icon-pencil" aria-hidden="true"></i></button>
                                                    <button class="btn btn-sm btn-icon on-default button-remove"
                                                        data-toggle="tooltip" data-original-title="Eliminar"><i
                                                            class="icon-trash" aria-hidden="true"></i></button>
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

@endsection

@section('before-scripts')

@endsection

@section('page-script')
    <script src="/admin/assets/bundles/dataTables.bundle.js"></script>
    <script src="/admin/assets/js/table/datatable.js"></script>
@endsection
