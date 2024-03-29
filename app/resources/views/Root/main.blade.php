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
                <a href="{{ route('root.index') }}" id="dashboard"><span class="icon home"
                        aria-hidden="true"></span>Dashboard</a>
            </li>
        </ul>
        <span class="system-menu__title">system</span>
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('company.index') }}" id="company"><span class="icon office"
                        aria-hidden="true"></span>Gerencias</a>
            </li>
        </ul>

    </div>
@endsection
