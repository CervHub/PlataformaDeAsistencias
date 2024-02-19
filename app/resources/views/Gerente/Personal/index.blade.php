@extends('Gerente.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
    <h2 class="main-title">Personal</h2>
    <div class="row mb-3 px-1 d-flex justify-content-between">
        <div class="col-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i> Crear
            </button>
        </div>
        <div class="col-2 d-flex justify-content-end">
            <form action="{{ route('personal.upload') }}" method="post" enctype="multipart/form-data"
                style="display: inline-block;">
                @csrf
                <input type="file" name="excel" accept=".xlsx,.xls" onchange="this.form.submit()"
                    style="display: none;" id="fileUpload">
                <label for="fileUpload" class="btn btn-warning">
                    <i class="fas fa-upload"></i> Subida Masiva
                </label>
            </form>
        </div>
    </div>

    {{-- Mostrar tabla empleados --}}
    @include('Gerente.Personal.table')
    @include('Gerente.Personal.create')
    @include('Gerente.Personal.edit')
    @include('Gerente.Personal.delete')
@endsection

@section('scripts')
    @include('Gerente.Personal.scripts')
@endsection
