@extends('layouts.layouts')

@section('content')
<h1>Dashboard</h1>
<h4>Bienvenido  {{auth()->user()->name}}</h4>


@endsection
