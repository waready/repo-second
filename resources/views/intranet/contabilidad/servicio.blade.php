@extends('layouts.app')
@section('titulo', 'Orden de Servicio')

@section('content')
<i-servicio-solicitud-compra :permissions="{{ $permisos }}"></i-servicio-solicitud-compra>

@endsection

@section('scripts')

@endsection