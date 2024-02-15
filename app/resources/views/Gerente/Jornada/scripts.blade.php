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
            from: 540,
            to: 1020,
            step: 15,
            prettify: function(num) {
                var m = num % 60;
                var h = (num - m) / 60;
                return h.toString().padStart(2, "0") + ":" + m.toString().padStart(2, "0");
            },
            disable: true,
            onChange: function(data) {
                // data.input[0] contains the input element
                console.log('Range ID: ' + data.input[0].id);
                console.log('Range selected: ' + data.from_pretty + ' to ' + data.to_pretty);
            }
        });

        $('.day-button').click(function() {
            var dayButtonId = $(this).attr('id');
            var dayRangeId = dayButtonId.replace('Button', 'Range');
            var dayRangeSlider = $('#' + dayRangeId).data("ionRangeSlider");

            if (dayRangeSlider.options.disable) {
                dayRangeSlider.update({
                    disable: false
                });
                $(this).removeClass('btn-outline-primary').addClass('btn-primary');
            } else {
                dayRangeSlider.update({
                    disable: true
                });
                $(this).removeClass('btn-primary').addClass('btn-outline-primary');
            }
        });
    });
</script>
