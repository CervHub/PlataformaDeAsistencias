<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CervAsist | Iniciar Sesión</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('template/css/style.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <style>
        input[type="radio"] {
            margin-right: 1rem;
        }

        .form-radio {
            margin-right: 14%;
            display: flex;
            justify-content: space-between;
            margin-left: 14%;
        }
    </style>
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">¡Bienvenido de nuevo!</h1>
            <p class="sign-up__subtitle">Inicia sesión en tu cuenta para continuar</p>

            <form class="sign-up-form form" action="{{ route('loginauth') }}" method="POST" autocomplete="off">
                @csrf
                <!-- Selector para el tipo de login -->
                <div class="form-radio">
                    <label class="form-checkbox-wrapper">
                        <input class="form-checkbox" type="radio" name="tipo_login" value="empresa"
                            onclick="cambiarCampo()" required checked>
                        <span class="form-checkbox-label">Empresa</span>
                    </label>

                    <label class="form-checkbox-wrapper">
                        <input class="form-checkbox" type="radio" name="tipo_login" value="personal"
                            onclick="cambiarCampo()" required>
                        <span class="form-checkbox-label">Persona</span>
                    </label>
                </div>

                <!-- Campo dinámico (RUC o Email) -->
                <label class="form-label-wrapper">
                    <p class="form-label" id="labelCampo">RUC</p>
                    <input class="form-input" type="text" id="campoLogin" placeholder="Ingresa tu RUC"
                        pattern="[0-9]*" required autocomplete="off" name="email">
                </label>

                <label class="form-label-wrapper">
                    <p class="form-label">Contraseña</p>
                    <input class="form-input" type="password" placeholder="Ingresa tu contraseña" required
                        autocomplete="off" name="password">
                </label>
                <a class="link-info forget-link" href="##">¿Olvidaste tu contraseña?</a>
                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox" type="checkbox" required>
                    <span class="form-checkbox-label">Recordarme la próxima vez</span>
                </label>
                <button class="form-btn primary-default-btn transparent-btn">Iniciar sesión</button>
            </form>
        </article>
    </main>
    <!-- Biblioteca de gráficos -->
    <script src="{{ asset('template/plugins/chart.min.js') }}"></script>
    <!-- Biblioteca de iconos -->
    <script src="{{ asset('template/plugins/feather.min.js') }}"></script>
    <!-- Scripts personalizados -->
    <script src="{{ asset('template/js/script.js') }}"></script>

    <script>
        function cambiarCampo() {
            var tipoLogin = document.querySelector('input[name="tipo_login"]:checked').value;
            var labelCampo = document.getElementById('labelCampo');
            var campoLogin = document.getElementById('campoLogin');

            if (tipoLogin === 'empresa') {
                labelCampo.innerHTML = 'RUC';
                campoLogin.placeholder = 'Ingresa tu RUC';
                campoLogin.pattern = '[0-9]*'; // Solo permite números
                campoLogin.type = 'text';
            } else {
                labelCampo.innerHTML = 'Email';
                campoLogin.placeholder = 'Ingresa tu email';
                campoLogin.pattern = '[^\\s]+'; // No permite espacios
                campoLogin.type = 'email';
            }
        }
    </script>
    @if (session('error'))
        <script>
            iziToast.error({
                title: 'Error',
                position: 'center',
                message: '{{ session('error') }}',
                class: 'custom-toast', // Agregar una clase personalizada
                timeout: 50000, // Tiempo de duración del mensaje
                progressBar: true
            });
        </script>

        <style>
            .custom-toast {
                border-radius: 15px !important;
            }

            .iziToast.iziToast-theme-light:after {
                box-shadow: none !important;
            }

            .custom-toast .iziToast-progressbar {
                left: 1% !important; // Mover la barra de progreso 15px desde la izquierda
                right: 0 !important; // Mover la barra de progreso a la derecha
                width: 80% !important; // Ajustar el ancho de la barra de progreso al 80%
            }
        </style>
    @endif
</body>

</html>
