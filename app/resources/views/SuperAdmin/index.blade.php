@extends('SuperAdmin.main')

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén el elemento dashboard
            var dashboard = document.querySelector('#dashboard');

            // Asegúrate de que el elemento dashboard existe
            if (dashboard) {
                // Agrega la clase 'active'
                dashboard.classList.add('active');
            }
        });
    </script>
@endsection
