<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

<script>
    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         dom: 'Bfrtip',
    //         buttons: [
    //             'copy', 'csv', 'excel', 'pdf', 'print'
    //         ]
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function() {
        activateElementById('administrador');
    });
</script>


<script>
    $(document).ready(function() {
        // Initialize all sliders in disabled state
        $('.day-range').ionRangeSlider({
            type: "double",
            grid: true,
            skin: "round",
            min: 0,
            max: 1440,
            from: 480,
            to: 1110,
            step: 15,
            prettify: function(num) {
                var m = num % 60;
                var h = (num - m) / 60;
                return h.toString().padStart(2, "0") + ":" + m.toString().padStart(2, "0");
            },
            disable: true,
            onChange: function(data) {
                // data.input[0] contiene el elemento de entrada
                console.log('Range ID: ' + data.input[0].id);
                console.log('Range selected: ' + data.from_pretty + ' to ' + data.to_pretty);

                // Convertir las cadenas de texto a números antes de hacer la resta
                var from_pretty = convertToHours(data.from_pretty);
                var to_pretty = convertToHours(data.to_pretty);

                if (!isNaN(from_pretty) && !isNaN(to_pretty)) {
                    var hours = to_pretty - from_pretty;
                    console.log(`${(data.input[0].id)[0]}Hours`);
                    console.log('Horas: ' + hours);
                    var hoursFormatted = formatHours(hours);
                    $(`#${(data.input[0].id)[0]}Hours`).val(hoursFormatted);
                } else {
                    console.error('Error: Invalid time format');
                }
                var totalHours = calculateTotalHours();
                console.log(totalHours);
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
            }
        });

        $('.day-button').click(function() {
            var dayButtonId = $(this).attr('id');
            var dayRangeId = dayButtonId.replace('Button', 'Range');
            var dayRangeSlider = $('#' + dayRangeId).data("ionRangeSlider");
            console.log(dayButtonId);
            console.log(dayRangeId);

            if (dayRangeSlider.options.disable) {
                dayRangeSlider.update({
                    disable: false
                });
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                $(`#${dayButtonId[0]}Hours`).val('10:30');
                var totalHours = calculateTotalHours();
                console.log(totalHours);

            } else {
                dayRangeSlider.update({
                    disable: true
                });
                $(this).removeClass('btn-primary').addClass('btn-outline-primary');
                $(`#${dayButtonId[0]}Hours`).val('00:00');
                var totalHours = calculateTotalHours();
                console.log(totalHours);
            }
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

        // Obtener las horas de receso y restarlas de totalHours
        var recessHours = convertToHours($('#horas_receso').val());
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
