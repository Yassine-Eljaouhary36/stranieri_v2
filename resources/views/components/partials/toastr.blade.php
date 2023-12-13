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

        // Use Toastr to display the success message
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        if (icon == 'success'){
            toastr.success(message);
        }
        if (icon == 'error'){
            toastr.error(message);
        }
        if (icon == 'warning'){
            toastr.warning(message);
        }
        if (icon == 'info'){
            toastr.warning(message);
        }
        if (icon == 'question'){
            toastr.warning(message);
        }

    }
</script>

@if ($customAlert = session('custom_alert'))
    @push('scripts')
        <script>
            callAlert({
                title: '{{ $customAlert['title'] }}',
                message: '{{ $customAlert['message'] }}',
                icon: '{{ $customAlert['type'] }}'
            });
        </script>
    @endpush
@endif