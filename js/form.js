$(document).ready(function() {
    // Seleccionar un país del desplegable
    $("#pais").change(function() {
        let paisId = $(this).val(); // Obtiene el ID del país seleccionado

        $.ajax({
            url: '../controller/ajax/ajax_handler.php',
            type: "GET",
            data: {
                action: 'getProvByPaisId',
                pais_id: paisId 
            },
            success: function(response) {
                var data = JSON.parse(response);

                if (data.items !== 'empty') {
                    // Si hay provincias, creamos el select
                    let selectHTML = '<div class="form-group"><label for="prov">Provincia</label><select class="form-control" id="prov">';

                    // Recorrer los elementos de 'items' y generar las opciones
                    $.each(data.items, function(index, provincia) {
                        selectHTML += `<option value="${provincia.PROVINCIA_ID}">${provincia.NOMBRE}</option>`;
                    });

                    selectHTML += '</select></div>';
                    $("#prov-container").html(selectHTML);
                } else {
                    // Si no hay provincias, eliminamos el select
                    $("#prov-container").html("");
                }
            }
        });
    });

    // Envío de formulario
    $("#formulario").submit(function(event) {
        // Evitar recargar la página
        event.preventDefault();

        // Recoger los datos del formulario
        let formData = {
            name: $("#name").val(),
            phone: $("#phone").val(),
            email: $("#email").val(),
            pais: $("#pais").val(),
            provincia: $("#prov").val(),
            cp: $("#cp").val(),
            condiciones: $("#condiciones").prop("checked")
        };

        $.ajax({
            url: '../controller/ajax/ajax_handler.php',
            type: "POST",
            data: {
                action: 'createRegisterCupon',
                data: formData
            },
            success: function(response) {
                var data = JSON.parse(response);

                if (data.errors) {
                    // Creamos el alert-danger para listar los errores
                    let selectHTML = '<div class="alert alert-danger" role="alert"><ul>';

                    // Recorrer los errores y los listamos
                    $.each(data.errors, function(field, errorMessage) {
                        selectHTML += `<li>${errorMessage}</li>`;
                    });

                    selectHTML += '</ul></div>';

                    // Mostrar los errores en el contenedor (descomenté el código)
                    $(".alertForm").html(selectHTML);
                } else if (data.error) {
                    // Creamos el alert-danger para listar los errores
                    let selectHTML = '<div class="alert alert-danger" role="alert"><ul><li>Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.</li></ul></div>';

                    // Mostrar los errores en el contenedor
                    $(".alertForm").html(selectHTML);
                } else {
                    // Creamos el alert-success cuando el registro de inserta de forma correcta
                    let selectHTML = '<div class="alert alert-success" role="alert"><ul><li>Se ha creado tu petición de forma correcta. Muchas gracias.</li></ul></div>';

                    // Mostrar los errores en el contenedor
                    $(".alertForm").html(selectHTML);

                    // Esperamos 5 segundos para ocultar el mensaje y limpiar el formulario
                    setTimeout(function() {
                        // Ocultamos el alert de éxito
                        $(".alertForm").html('');

                        // Limpiamos los campos del formulario excepto provincia
                        $('#formulario')[0].reset(); // Esto limpia todos los campos del formulario
                        // Limpiamos los campos provincia
                        $("#prov-container").html("");
                    }, 5000); // 5000 milisegundos = 5 segundos
                }
            }
        });
    });
});
