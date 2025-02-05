$(document).ready(function() {
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
});
