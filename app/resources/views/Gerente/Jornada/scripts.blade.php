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
        activateElementById('jornadas');
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
        },
        "almuerzo": {
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
    function calculateTotalLunch(destino, id) {

        var days = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        var totalHours = 0;

        for (var i = 0; i < days.length; i++) {
            var sliderId = days[i] + id;
            var slider = $("#lunch" + sliderId).data("ionRangeSlider");
            console.log('#lunch' + sliderId);
            if (slider && !slider.options.disable) {
                totalHours += slider.result.to - slider.result.from;
            }
        }
        console.log('#' + destino);

        $('#' + destino).val(prettify(totalHours));
        calculateTotalLaborable();
    }

    function calculateTotalLaborable() {
        let totalHours = $('#totalHours').val();
        let lunchHours = $('#lunchHours').val();
        let totalLaborable = unprettify(totalHours) - unprettify(lunchHours);
        $('#workHours').val(prettify(totalLaborable));
    }

    $('#store').click(function() {
        let days = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        for (let i = 0; i < days.length; i++) {
            let day = days[i];
            let range = $(`#${day}Range`).data("ionRangeSlider");
            let lunch = $(`#lunch${day}Range`).data("ionRangeSlider");

            if (!range.options.disable) {
                dataJson.horario[day].from = prettify(range.result.from);
                dataJson.horario[day].to = prettify(range.result.to);
            }

            if (!lunch.options.disable) {
                dataJson.almuerzo[day].from = prettify(lunch.result.from);
                dataJson.almuerzo[day].to = prettify(lunch.result.to);
            }
        }
        $('#datajson').val(JSON.stringify(dataJson));
    });


    function prettify(num) {
        var m = num % 60;
        var h = (num - m) / 60;
        return h.toString().padStart(2, "0") + ":" + m.toString().padStart(2, "0");
    }

    function unprettify(time) {
        var parts = time.split(":");
        var h = parseInt(parts[0], 10);
        var m = parseInt(parts[1], 10);
        return h * 60 + m;
    }

    function calculateTotal(destino, id) {
        var days = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        var totalHours = 0;

        for (var i = 0; i < days.length; i++) {
            var sliderId = days[i] + id;
            var slider = $("#" + sliderId).data("ionRangeSlider");
            console.log('#' + sliderId);
            if (slider && !slider.options.disable) {
                totalHours += slider.result.to - slider.result.from;
            }
        }
        console.log('#' + destino);

        $('#' + destino).val(prettify(totalHours));
        calculateTotalLaborable();
    }

    $(document).ready(function() {
        // Initialize all sliders in disabled state
        $('.day-range').each(function() {
            console.log('ID del control deslizante de rango: ' + this.id);
            let min = 0;
            let max = 1440;
            let from = 480;
            let to = 1110;
            let skin = "flat";
            animate = true;
            if (this.id.startsWith('lunch')) {
                min = 480;
                max = 1110;
                from = 780;
                to = 840;
                $(this).parent().addClass(
                    'lunch-slider');
                animate = false;
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
                prettify: prettify,
                disable: true,
                animate: animate,
                onChange: function(data) {
                    console.log("ID del elemento: " + data.input[0].id);
                    console.log("Valor mínimo: " + data.from);
                    console.log("Valor máximo: " + data.to);

                    if (!data.input[0].id.startsWith('lunch')) {
                        var nextSliderId = 'lunch' + data.input[0].id;
                        var nextSlider = $("#" + nextSliderId).data("ionRangeSlider");

                        nextSlider.update({
                            min: data.from,
                            max: data.to
                        });

                        //Actualizamos el dia
                        let day = data.to - data.from;
                        $(`#${data.input[0].id[0]}Day`).val(prettify(day));
                        calculateTotal('totalHours', 'Range');

                    } else {
                        calculateTotalLunch('lunchHours', 'Range');
                    }

                }
            });
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
            if (isDisabled) {
                $(`#${dayRangeId[0]}Day`).val(prettify(dayRangeSlider.result.to - dayRangeSlider.result
                    .from));
            } else {
                $(`#${dayRangeId[0]}Day`).val('00:00');
            }
            // Actualiza el estado de los controles deslizantes y el color del botón basado en el estado actual
            dayRangeSlider.update({
                disable: !isDisabled
            });
            dayLunchSlider.update({
                disable: !isDisabled
            });
            $(this).toggleClass('btn-outline-primary btn-primary');
            calculateTotal('totalHours', 'Range');
            calculateTotalLunch('lunchHours', 'Range');
            calculateTotalLaborable();
        });

    });
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
