@extends('Gerente.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
    <h2 class="main-title">Administrador</h2>
    <div class="row mb-3 px-1">
        <div class="col-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i> Crear
            </button>
        </div>
    </div>

    @include('Gerente.Administrador.table')
    @include('Gerente.Administrador.create')
@endsection

@section('scripts')
    @include('Gerente.Administrador.scripts')
@endsection
