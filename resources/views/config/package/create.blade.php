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
            <li class="breadcrumb-item "><a href="#">Configuración</a></li>
            <li class="breadcrumb-item "><a href="{{route('package.index')}}">Paquetes</a></li>
            <li class="breadcrumb-item active">Crear</li>
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
                            <h3 class="card-title"><strong> Crear Nuevo Paquete</strong></h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                        class="fe fe-chevron-up"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Nombre del Paquete</label>
                                            <input  type="text"
                                                    id="name"
                                                    name="name"
                                                    class="form-control"
                                                    value=""
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Código</label>
                                            <input  type="text"
                                                    id="code"
                                                    name="code"
                                                    class="form-control"
                                                    value=""
                                            >
                                        </div>
                                    </div>




{{--                                <div class="col-lg-12">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h3 class="card-title">Detalle del Paquete</h3>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <table class="table table-striped mb-0">--}}
{{--                                                    <thead>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>#</th>--}}
{{--                                                        <th>Cod Producto</th>--}}
{{--                                                        <th>Nombre</th>--}}

{{--                                                    </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                        <tr>--}}
{{--                                                            <th scope="row">1</th>--}}
{{--                                                            <td>F6</td>--}}
{{--                                                            <td>Fotos 8 Imagenes</td>--}}
{{--                                                        </tr>--}}

{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-secondary btn-sm ml-2">Guardar</button>
                        </div>
                        </form>
                    </div>

                    <div>

                        <div >
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">

                    {{-- Section --}}
{{--                    @include('config.package.orderselect')--}}
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
