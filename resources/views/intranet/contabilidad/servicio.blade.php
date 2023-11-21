@extends('layouts.app')
@section('titulo', 'Orden de Servicio')

@section('content')
<i-servicio-solicitud :permissions="{{ $permisos }}"></i-servicio-solicitud>

@endsection

@section('scripts')

@endsection