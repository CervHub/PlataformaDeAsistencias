<script>
    document.addEventListener('DOMContentLoaded', function() {
        activateElementById('personal');
    });
</script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('#clear').click(function() {
            $('#createForm')[0].reset();
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        activateElementById('company');
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

@if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#createModal').modal('show');
        });
    </script>
@endif

<script>
    $('.edit-company').click(function() {
        var id = $(this).closest('tr').data('id');
        console.log('ID:', id);
    });

    $('.delete-employee').click(function() {
        var id = $(this).closest('tr').data('id');
        console.log('ID:', id);

        var modal = $('#deleteModal');
        modal.find('.loading').show();
        modal.find('#deleteForm').hide();
        modal.modal('show');

        var client = new ApiClient('/api');
        client.sendRequest('/employee/show/' + id, 'GET', null, function(error, response) {
            if (error) {
                console.error('Error:', error);
                modal.modal('hide');
                alert(
                    'Ocurrió un error al obtener los detalles de la empresa. Por favor, inténtalo de nuevo.'
                );
            } else {
                console.log('Response:', response);
                modal.find('#documento_identidad').val(response.documento_identidad);
                modal.find('#nombres').val(response.nombres);
                modal.find('#apellidos').val(response.apellidos);
                modal.find('#posicion').val(response.posicion);
                modal.find('.loading').hide();
                modal.find('#deleteForm').show();
                // Actualizar la URL con el nuevo ID
                var url = '{{ route('personal.destroy', ['personal' => ':id']) }}';
                url = url.replace(':id', response.id);
                modal.find('#deleteFormPrimary').attr('action', url);
            }
        });
    });
</script>
