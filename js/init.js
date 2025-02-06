$(document).ready(function() {
    // Escuchar el botón de "Ver más"
    $(document).on('click', '.ver-mas', function() {
        var button = $(this); // botón pulsado
        var categoryId = button.data('category');  // Obtener el ID de la categoría
        var offset = button.data('offset');  // Obtener el offset actual
        var limit = 2;  // Número de ítems a cargar en cada solicitud
        var count = button.data('count'); // Total de registros por categoría

        // Mostrar el botón de "Ver menos"
        $('.ver-menos[data-category="'+categoryId+'"]').show();

        $.ajax({
            url: '../controller/ajax/ajax_handler.php',
            type: 'GET',
            data: {
                action: 'getItemsByCategoryMore',
                category_id: categoryId,
                offset: offset,
                limit: limit
            },
            success: function(response) {
                var data = JSON.parse(response);

                // Entramos si success es true
                if (data.success) {
                    // Localizamos el contenedor donde añadiremos los nuevos items
                    var itemsContainer = $('.categoria-' + categoryId).find('.items-container');

                    // Agregar los nuevos ítems al contenedor
                    data.items.forEach(function(item) {
                        var itemHtml = `
                            <div class="card ${item.sTipoCard}">
                                <div class="card-body">
                                    <div class="txt">
                                        <p>${item.sNombre}</p>
                                    </div>
                                    <div class="img">
                                        <img src="${item.sRutaImg}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsContainer.append(itemHtml);
                    });

                    // Actualizar el offset y data-limit en el botón "Ver menos"
                    var newOffset = offset + limit;
                    button.data('offset', newOffset);
                    $('.ver-menos[data-category="'+categoryId+'"]').data('limit', newOffset);

                    // Si ya no hay más ítems, ocultar el botón "Ver más"
                    if (newOffset >= count) {
                        button.hide();
                    }
                }
            }
        });
    });

    // Escuchar el botón de "Ver menos"
    $(document).on('click', '.ver-menos', function() {
        var button = $(this); // botón pulsado
        var categoryId = button.data('category');  // Obtener el ID de la categoría
        var currentLimit = button.data('limit');  // Obtener el límite actual
        var reductionLimit = 2;  // Número de ítems a reducir
        var newLimit = currentLimit - reductionLimit; // Calcular el nuevo límite

        // Mostrar el botón de "Ver más"
        $('.ver-mas[data-category="'+categoryId+'"]').show();

        $.ajax({
            url: '../controller/ajax/ajax_handler.php',
            type: 'GET',
            data: {
                action: 'getItemsByCategoryLess',
                category_id: categoryId,
                limit: newLimit
            },
            success: function(response) {
                var data = JSON.parse(response);

                // Entramos si success es true
                if (data.success) {
                    // Localizamos el contenedor donde colocaremos los items
                    var itemsContainer = $('.categoria-' + categoryId).find('.items-container');

                    // Limpiar y volver a agregar solo los ítems que queremos mostrar en el contenedor
                    itemsContainer.empty();
                    data.items.forEach(function(item) {
                        var itemHtml = `
                            <div class="card ${item.sTipoCard}">
                                <div class="card-body">
                                    <div class="txt">
                                        <p>${item.sNombre}</p>
                                    </div>
                                    <div class="img">
                                        <img src="${item.sRutaImg}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        `;
                        itemsContainer.append(itemHtml);
                    });

                    // Actualizar el data-limit del botón "Ver menos"
                    button.data('limit', newLimit);
                    $('.ver-menos[data-category="'+categoryId+'"]').attr('data-limit', newLimit);

                    // Actualizar el offset en el botón "Ver más" para que funcione correctamente después de reducir
                    $('.ver-mas[data-category="'+categoryId+'"]').data('offset', newLimit);

                    // Si llegamos a 5 ítems, ocultar el botón "Ver menos"
                    if (newLimit <= 5) {
                        button.hide();
                    }
                }
            }
        });
    });
});
