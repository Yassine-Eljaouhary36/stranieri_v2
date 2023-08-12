<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function callAlert({
        title = 'error!',
        message = 'message',
        icon = 'error'
    }) {

        if (
            icon != 'error' &&
            icon != 'success' &&
            icon != 'warning' &&
            icon != 'info' &&
            icon != 'question'
        ) {
            icon = 'error';
        }

        Swal.fire({
            title: title,
            text: message,
            icon: icon,
            //confirmButtonText: 'ok'
        });
    }
</script>


@if ($customAlert = session('custom_alert'))
    <script>
        callAlert({
            title: '{{ $customAlert['title'] }}',
            message: '{{ $customAlert['message'] }}',
            icon: '{{ $customAlert['type'] }}'
        });
    </script>
@endif