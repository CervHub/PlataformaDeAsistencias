<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        activateElementById('administrador');
    });
    let dataJson = {
        "horario": {
            "L": {
                "from": "00:00",
                "to": "00:00"
            },
            "M": {
                "from": "00:00",
                "to": "00:00"
            },
            "X": {
                "from": "00:00",
                "to": "00:00"
            },
            "J": {
                "from": "00:00",
                "to": "00:00"
            },
            "V": {
                "from": "00:00",
                "to": "00:00"
            },
            "S": {
                "from": "00:00",
                "to": "00:00"
            },
            "D": {
                "from": "00:00",
                "to": "00:00"
            }
        }
    };
</script>


<script>
    function calculateTotalLunch() {

        var disabledCount = $('.irs-disabled').length;
        var result = 7 - disabledCount;
        var hours = parseInt($('#horas_receso').val().split(':')[0]);
        var totalHours = hours * result;
        $('#lunchHours').val(('0' + totalHours).slice(-2) + ':00');
    }

    $('#store').click(function() {
        $('#datajson').val(JSON.stringify(dataJson));
    });

    $(document).ready(function() {
        // Initialize all sliders in disabled state
        $('.day-range').each(function() {
            console.log('ID del control deslizante de rango: ' + this.id);
            let min = 0;
            let max = 1440;
            let from = 480;
            let to = 1110;
            let skin = "flat";
            if (this.id.startsWith('lunch')) {
                min = 480;
                max = 1110;
                from = 780;
                to = 840;
                $(this).parent().addClass(
                    'lunch-slider');
            } else {
                $(this).parent().addClass(
                    'work-slider');
            }
            $(this).ionRangeSlider({
                type: "double",
                grid: true,
                skin: skin,
                min: min,
                max: max,
                from: from,
                to: to,
                step: 15,
                prettify: function(num) {
                    var m = num % 60;
                    var h = (num - m) / 60;
                    return h.toString().padStart(2, "0") + ":" + m.toString().padStart(2,
                        "0");
                },
                disable: true,
                // onChange: function(data) {
                //     // data.input[0] contiene el elemento de entrada
                //     console.log('Range ID: ' + data.input[0].id);
                //     console.log('Range selected: ' + data.from_pretty + ' to ' + data
                //         .to_pretty);
                //     dataJson.horario[data.input[0].id[0]].from = data.from_pretty;
                //     dataJson.horario[data.input[0].id[0]].to = data.to_pretty;
                //     console.log(dataJson);

                //     // Convertir las cadenas de texto a números antes de hacer la resta
                //     var from_pretty = convertToHours(data.from_pretty);
                //     var to_pretty = convertToHours(data.to_pretty);

                //     if (!isNaN(from_pretty) && !isNaN(to_pretty)) {
                //         var hours = to_pretty - from_pretty;
                //         console.log(`${(data.input[0].id)[0]}Hours`);
                //         console.log('Horas: ' + hours);
                //         var hoursFormatted = formatHours(hours);
                //         $(`#${(data.input[0].id)[0]}Hours`).val(hoursFormatted);
                //     } else {
                //         console.error('Error: Invalid time format');
                //     }
                //     var totalHours = calculateTotalHours();
                //     console.log(totalHours);
                //     // Función para convertir 'HH:MM' a horas totales
                //     function convertToHours(time) {
                //         var parts = time.split(':');
                //         if (parts.length === 2) {
                //             var hours = parseInt(parts[0], 10);
                //             var minutes = parseInt(parts[1], 10);
                //             if (!isNaN(hours) && !isNaN(minutes)) {
                //                 return hours + minutes / 60;
                //             }
                //         }
                //         return NaN;
                //     }
                //     // Función para convertir horas decimales a formato 'HH:MM'
                //     function formatHours(decimalHours) {
                //         var hours = Math.floor(decimalHours);
                //         var minutes = Math.round((decimalHours - hours) * 60);
                //         return `${pad(hours)}:${pad(minutes)}`;
                //     }

                //     // Función para añadir un cero a la izquierda si el número es menor que 10
                //     function pad(number) {
                //         return number < 10 ? '0' + number : number;
                //     }
                // }
            });
        });

        $('#horas_receso').change(function() {
            calculateTotalLunch();
            calculateTotalHours();
        });

        // Agrega un controlador de eventos de clic a todos los elementos con la clase 'day-button'
        $('.day-button').click(function() {
            // Obtiene el ID del botón que fue clickeado
            var dayButtonId = $(this).attr('id');

            // Reemplaza 'Button' con 'Range' en el ID para obtener el ID del control deslizante de rango correspondiente
            var dayRangeId = dayButtonId.replace('Button', 'Range');

            // Obtiene las instancias de los controles deslizantes de rango y almuerzo usando los IDs
            var dayRangeSlider = $('#' + dayRangeId).data("ionRangeSlider");
            var dayLunchSlider = $('#lunch' + dayRangeId).data("ionRangeSlider");

            // Verifica si los controles deslizantes están deshabilitados
            var isDisabled = dayRangeSlider.options.disable;

            // Actualiza el estado de los controles deslizantes y el color del botón basado en el estado actual
            dayRangeSlider.update({
                disable: !isDisabled
            });
            dayLunchSlider.update({
                disable: !isDisabled
            });
            $(this).toggleClass('btn-outline-primary btn-primary');
        });

    });

    function calculateTotalHours() {
        var days = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        var totalHours = 0;

        for (var i = 0; i < days.length; i++) {
            var day = days[i];
            var hours = $(`#${day}Hours`).val();

            if (hours) {
                // Convertir las horas a un número y sumarlas a totalHours
                totalHours += convertToHours(hours);
            } else {
                console.log(`El elemento con ID #${day}Hours no existe o no tiene valor.`);
            }
        }
        calculateTotalLunch();

        // Obtener las horas de receso y restarlas de totalHours
        var recessHours = convertToHours($('#lunchHours').val());
        var workHours = totalHours - recessHours;

        // Convertir workHours a formato 'HH:MM' y actualizar el valor del elemento con ID 'workHours'
        var workHoursFormatted = formatHours(workHours);
        $('#workHours').val(workHoursFormatted);

        // Convertir totalHours a formato 'HH:MM' y actualizar el valor del elemento con ID 'totalHours'
        var totalHoursFormatted = formatHours(totalHours);
        $('#totalHours').val(totalHoursFormatted);

        return totalHours;
    }

    // Función para convertir 'HH:MM' a horas totales
    function convertToHours(time) {
        var parts = time.split(':');
        if (parts.length === 2) {
            var hours = parseInt(parts[0], 10);
            var minutes = parseInt(parts[1], 10);
            if (!isNaN(hours) && !isNaN(minutes)) {
                return hours + minutes / 60;
            }
        }
        return NaN;
    }

    // Función para convertir horas decimales a formato 'HH:MM'
    function formatHours(decimalHours) {
        var hours = Math.floor(decimalHours);
        var minutes = Math.round((decimalHours - hours) * 60);
        return `${pad(hours)}:${pad(minutes)}`;
    }

    // Función para añadir un cero a la izquierda si el número es menor que 10
    function pad(number) {
        return number < 10 ? '0' + number : number;
    }
</script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: '{{ session('warning') }}',
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
@endif
