@extends('backend.base')

@section('content')

    @can('view_CA')
        <h1>Chiffre d'affaire</h1>
    @endcan

@endsection