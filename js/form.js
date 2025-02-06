$(document).ready(function() {
    // Seleccionar un país del desplegable
    $("#pais").change(function() {
        let paisId = $(this).val();

        $.ajax({
            url: '../controller/ajax/ajax_handler.php',
            type: "GET",
            data: {
                action: 'getProvByPaisId',
                pais_id: paisId 
            },
            success: function(response) {
                var data = JSON.parse(response);

                // Si hay provincias, creamos el select
                if (data.items !== 'empty') {
                    // Creamos el div correspondiente y recorremos los 'items' para generar las provincias
                    let selectHTML = '<div class="form-group"><label for="prov">Provincia</label><select class="form-control" id="prov">';
                    $.each(data.items, function(index, provincia) {
                        selectHTML += `<option value="${provincia.PROVINCIA_ID}">${provincia.NOMBRE}</option>`;
                    });
                    selectHTML += '</select></div>';

                    // Añadimos el select al apartado provincias del formulario
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
        event.preventDefault(); // Evitar recargar la página

        // Datos del formulario
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

                // Si devolvemos 'errors' es por tener errores de validación
                if (data.errors) {
                    // Creamos alert-danger para listar los errores. Se recorren y se pintan
                    let selectHTML = '<div class="alert alert-danger" role="alert"><ul>';
                    $.each(data.errors, function(field, errorMessage) {
                        selectHTML += `<li>${errorMessage}</li>`;
                    });
                    selectHTML += '</ul></div>';

                    // Añadimos alert-danger al apartado de alert en el formulario
                    $(".alertForm").html(selectHTML);
                } else if (data.error) { // Si devolvemos 'error' es por un error interno
                    // Creamos alert-danger para mostrar mensaje de error
                    let selectHTML = '<div class="alert alert-danger" role="alert"><ul><li>' + data.error + '</li></ul></div>';

                    // Añadimos alert-danger al apartado de alert en el formulario
                    $(".alertForm").html(selectHTML);
                } else { // Todo correcto
                    // Creamos alert-success para mostrar mensaje de éxito
                    let selectHTML = '<div class="alert alert-success" role="alert"><ul><li>Se ha creado tu petición de forma correcta. Muchas gracias.</li></ul></div>';

                    // Añadimos alert-success al apartado de alert en el formulario
                    $(".alertForm").html(selectHTML);

                    // En 5 segundos ocultamos mensaje y limpiamos formulario
                    setTimeout(function() {
                        $(".alertForm").html('');
                        $('#formulario')[0].reset(); // Esto limpia todos los campos del formulario
                        $("#prov-container").html(""); // Limpia el campo de provincia
                    }, 5000); // 5000 milisegundos = 5 segundos
                }
            }
        });
    });
});
