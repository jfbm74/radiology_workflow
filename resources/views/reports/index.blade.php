@extends('layouts.layouts')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item">Reportes</li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="Project-OnGoing" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">REPORTES DE PRODUCTIVIDAD</h3>
                                    <div class="card-options">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="tag tag-blue mb-3">Productividad</span>
                                    <p>Principales reportes acerca del comportamiento de las órdenes de servicio</p>
                                    <div class="row">
                                        <div class="col-5 py-1"><strong>Creado:</strong></div>
                                        <div class="col-7 py-1">16 Abril 2021</div>
                                        <div class="col-5 py-1"><strong>Version:</strong></div>
                                        <div class="col-7 py-1">v1.0</div>
                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>
                                        <div class="col-5 py-1"><a href="{{route('report.productivity.detail')}}"> <span class="tag tag-cyan">Productividad Detallado</span></a></div>
                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>
                                        <div class="col-5 py-1"><a href="{{route('report.opportunity')}}"> <span class="tag tag-azure">Oportunidad Detallado</span></a></div>
                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>
                                        <div class="col-5 py-1"><a href="{{route('report.paquetes')}}"> <span class="tag tag-azure">Paquetes</span></a></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-lg-4 col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">DIMENSIÓN: PROFESIONALES</h3>--}}
{{--                                    <div class="card-options">--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <span class="tag tag-pink mb-3">Profesionales</span>--}}
{{--                                    <p>Reportes por profesional relacionando el número de órdenes referidas</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-5 py-1"><strong>Creado:</strong></div>--}}
{{--                                        <div class="col-7 py-1">16 Abril 2021</div>--}}
{{--                                        <div class="col-5 py-1"><strong>Por:</strong></div>--}}
{{--                                        <div class="col-7 py-1">Juan Felipe Bustamante</div>--}}
{{--                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>--}}
{{--                                        <div class="col-5 py-1"><span class="tag tag-cyan">Órdenes Consolidado</span></div>--}}
{{--                                        </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-footer">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DIMENSIÓN: PACIENTE</h3>
                                    <div class="card-options">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="tag tag-blue mb-3">Paciente</span>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-5 py-1"><strong>Creado:</strong></div>
                                        <div class="col-7 py-1">16 Abril 2021</div>
                                        <div class="col-5 py-1"><strong>Version:</strong></div>
                                        <div class="col-7 py-1">v1.0</div>
                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>
                                        <div class="col-5 py-1"><a href="{{route('report.dosimetry')}}"><span class="tag tag-cyan">Dosis de Radiación</span></a> </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-lg-4 col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">DIMENSIÓN: SEGURIDAD DEL PACIENTE</h3>--}}
{{--                                    <div class="card-options">--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <span class="tag tag-blue mb-3">Paciente</span>--}}
{{--                                    <p>Principales reportes acerca del comportamiento de las órdenes de servicio</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-5 py-1"><strong>Creado:</strong></div>--}}
{{--                                        <div class="col-7 py-1">16 Abril 2021</div>--}}
{{--                                        <div class="col-5 py-1"><strong>Por:</strong></div>--}}
{{--                                        <div class="col-7 py-1">Juan Felipe Bustamante</div>--}}
{{--                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>--}}
{{--                                        <div class="col-5 py-1"><span class="tag tag-cyan">Productividad Detallado</span></div>--}}
{{--                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>--}}
{{--                                        <div class="col-5 py-1"><span class="tag tag-cyan">Productividad Consolidado</span></div>--}}
{{--                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>--}}
{{--                                        <div class="col-5 py-1"><span class="tag tag-azure">Oportunidad Detallado</span></div>--}}
{{--                                        <div class="col-5 py-1"><strong>Reporte:</strong></div>--}}
{{--                                        <div class="col-5 py-1"><span class="tag tag-azure">Oportunidad Consolidado</span></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="card-footer">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade" id="Project-UpComing" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-vcenter mb-0">
                                    <thead>
                                    <tr>
                                        <th>Owner</th>
                                        <th>Milestone</th>
                                        <th class="w100">Work</th>
                                        <th class="w100">Duration</th>
                                        <th>Priority</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar1.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Isidore Dilao</span></td>
                                        <td>Account receivable</td>
                                        <td><span>30:00</span></td>
                                        <td>30:0 hrs</td>
                                        <td><span class="text-warning">Medium</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar2.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Maricel Villalon</span></td>
                                        <td>Account receivable</td>
                                        <td><span>68:00</span></td>
                                        <td>105:0 hrs</td>
                                        <td><span class="text-danger">High</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar3.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Theresa Wright</span></td>
                                        <td>Approval site</td>
                                        <td><span>74:00</span></td>
                                        <td>89:0 hrs</td>
                                        <td><span>None</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar4.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Jason Porter</span></td>
                                        <td>Final touch up</td>
                                        <td><span>30:00</span></td>
                                        <td>30:0 hrs</td>
                                        <td><span>None</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar5.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Annelyn Mercado</span></td>
                                        <td>Account receivable</td>
                                        <td><span>30:00</span></td>
                                        <td>30:0 hrs</td>
                                        <td><span>None</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar6.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Sean Black</span></td>
                                        <td>Basement slab preparation</td>
                                        <td><span>88:00</span></td>
                                        <td>88:0 hrs</td>
                                        <td><span>None</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar7.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>Scott Ortega</span></td>
                                        <td>Account receivable</td>
                                        <td><span>56:00</span></td>
                                        <td>125:0 hrs</td>
                                        <td><span class="text-warning">Medium</span></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/images/xs/avatar8.jpg" alt="Avatar" class="w30 rounded-circle mr-2"> <span>David Wallace</span></td>
                                        <td>Account receivable</td>
                                        <td><span>30:00</span></td>
                                        <td>30:0 hrs</td>
                                        <td><span>None</span></td>
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
