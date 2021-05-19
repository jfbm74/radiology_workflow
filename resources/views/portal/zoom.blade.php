@extends('layouts.layouts')

@section('after-styles')
    <link rel="stylesheet" href="/admin/assets/css/blueimp/blueimp-gallery.min.css" />
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item ">Pacientes</li>
            <li class="breadcrumb-item active">Imágenes</li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media mb-1">
                <div class="media-body">
                    <div class="content">
                        <p class="h5">{{ $patient->name }} <small
                                @if (isset($admission->created_at))
                                    class="float-right badge badge-primary">{{ $admission->created_at->format('Y-m-d') }}</small>
                                @endif
                        </p>
                        <span>ID: {{ $patient->legal_id }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-2 col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="example">
                        <div class="form-group">
                            <div class="row gutters-sm">
                                @foreach ($photos as $photo)
                                    <a href="{{ route('patient.zoom', ['admission' => $admission, 'photo' => $photo]) }}">
                                        <div class="col-sm-12">
                                            <figure class="imagecheck-figure">
                                                <img style="width: 80px; height: 80px; object-fit: cover;"
                                                    src="{{ url($photo->url) }}" alt="" class="imagecheck-image" />
                                            </figure>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="col-sm-12">
                    <figure class="imagecheck-figure">
                        <img class="zoom" style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{ url($photo_zoom->url) }}" alt="" />
                    </figure>
                </div>
            </div>
        </div>
    </div>
    @endsection


    @section('page-script')
        <script src="/admin/assets/js/wheelzoom/wheelzoom.js"></script>
        <script>
            wheelzoom(document.querySelector('img.zoom'));

        </script>
    @endsection
