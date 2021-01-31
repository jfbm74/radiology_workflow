@extends('layouts.layouts')


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media mb-1">
                <div class="media-body">
                    <div class="content">
                        <p class="h5">{{ $patient->name }} <small
                                class="float-right badge badge-primary">{{ $admission->created_at->format('Y-m-d') }}</small>
                        </p>
                        <span>ID: {{ $patient->legal_id }}</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-body">
            <div class="example">
                <div class="form-group">
                    <div class="row gutters-sm">
                        @foreach ($photos as $photo)
                        <a href="{{route('patient.zoom', ['admission' => $admission, 'photo' => $photo]) }}">
                            <div class="col-sm-12">
                                <figure class="imagecheck-figure">
                                    <img    style="width: 80px; height: 80px; object-fit: cover;" 
                                            src="{{ url($photo->url) }}" alt="}"
                                            class="imagecheck-image" />
                                </figure>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
