// Prevenir double request

// if (typeof jQuery != 'undefined') {
if (window.jQuery) {
    console.log('jQuery okay')
    $(function() {
        $('.form-prevent').on('submit', function() {
            $('.button-prevent').attr('disabled', 'true');
            $('.spinner').show();
        });

        $('.form-submit').on('submit', function() {
            $('.form-submit').find('button').attr('disabled', 'true');
        });
    });
} else {
    // jQuery no está cargado
    console.log('sin jQuery')
    // console.error('jQuery no está cargado en la página.');
    document.addEventListener('DOMContentLoaded', function() {
        var formSubmit = document.querySelector('.form-submit');

        if (formSubmit) {
            formSubmit.addEventListener('submit', function(event) {
                // Evitar el envío del formulario
                event.preventDefault();

                // Deshabilitar el botón dentro del formulario
                var submitButton = formSubmit.querySelector('button');
                if (submitButton) {
                    submitButton.disabled = true;
                }
            });
        }
    });
}
