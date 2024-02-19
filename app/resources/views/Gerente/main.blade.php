@extends('template')

@section('sidebar')
    <div class="sidebar-head">
        <a href="/" class="logo-wrapper" title="Home">
            <span class="sr-only">Home</span>
            <span class="icon logo" aria-hidden="true"></span>
            <div class="logo-text">
                <span class="logo-title">Cerv</span>
                <span class="logo-subtitle">Dashboard</span>
            </div>

        </a>
        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle" aria-hidden="true"></span>
        </button>
    </div>
    <div class="sidebar-body">
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('gerencia.show') }}" id="dashboard"><span class="icon home"
                        aria-hidden="true"></span>Dashboard</a>
            </li>
        </ul>
        <span class="system-menu__title">Gestión</span>
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('talleres.index') }}" id="taller"><span class="icon office"
                        aria-hidden="true"></span>Talleres</a>
            </li>
            {{-- <li>
                <a href="{{ route('administradores.index') }}" id="administrador"><span class="icon access"
                        aria-hidden="true"></span>Administradores</a>
            </li> --}}
            <li>
                <a href="{{ route('personal.index') }}" id="personal"><span class="icon working"
                        aria-hidden="true"></span>Personal</a>
            </li>
        </ul>
        <span class="system-menu__title">Incidentes y Reportes</span>
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('incidentes.index') }}" id="incidente"><span class="icon incident"
                        aria-hidden="true"></span>Incidentes</a>
            </li>
            <li>
                <a href="{{ route('reportes.index') }}" id="reporte"><span class="icon report"
                        aria-hidden="true"></span>Reportes</a>
            </li>
        </ul>
        <span class="system-menu__title">Permisos y Horarios</span>
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('permisos.index') }}" id="permiso"><span class="icon permission"
                        aria-hidden="true"></span>Permisos</a>
            </li>
            <li>
                <a href="{{ route('horarios.index') }}" id="horario"><span class="icon calendar"
                        aria-hidden="true"></span>Horario</a>
            </li>
            <li>
                <a href="{{ route('jornadas.index') }}" id="jornadas"><span class="icon schedule"
                        aria-hidden="true"></span>Jornadas</a>
            </li>
        </ul>
    </div>
@endsection
