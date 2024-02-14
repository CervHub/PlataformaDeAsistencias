@extends('Gerente.main')

@section('content')
    <h2 class="main-title">Taller</h2>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            activateElementById('taller');
        });
    </script>
@endsection
