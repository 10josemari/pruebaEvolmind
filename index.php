<?php 
// Cabecera de la página
require 'includes/header.html'; // Se incluye el archivo de cabecera HTML

// Incluir archivos de conexión y controladores
include_once 'database/DbConnect.php';
include_once 'controller/CategoryController.php';
include_once 'controller/CountryController.php';

// Instancias de controladores
$categoryController = new CategoryController(); // Instancia para manejar las categorías
$countryController = new CountryController(); // Instancia para manejar los países

$categories = $categoryController->getListCategories(); // método `getListCategories` para todas las categorías
$paises = $countryController->getListCountries(); // método `getListCountries` para todos los países
?>

<main>
  <div class="container">
    <h1>Título Principal de la Página</h1>
    <div class="row">

      <!-- Listado de categorías -->
      <div class="col-12 col-lg-8 col-md-7 col-sm-12 col-contenido">
        <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $category): ?>
            <div class="categoria categoria-<?php echo $category['idCategoria']; ?>">
              <h2><?php echo htmlspecialchars($category['sNombre']); ?></h2>

              <!-- Items de la categoría actual -->
              <?php
                $items = $categoryController->getItemsByCategory($category['idCategoria']);
                $totalItems = $categoryController->getCountItemsByCategory($category['idCategoria']);
              ?>

              <?php if (!empty($items)): ?>
                <div class="items-container">
                  <?php foreach ($items as $item): ?>                      
                    <div class="card <?php echo htmlspecialchars($item['sTipoCard']); ?>">
                      <div class="card-body"> <!-- card-body -->
                        <div class="txt">
                          <p><?php echo htmlspecialchars($item['sNombre']); ?></p>
                        </div>
                        <div class="img">
                          <img src="<?php echo htmlspecialchars($item['sRutaImg']); ?>" alt="" class="img-fluid">
                        </div>
                      </div> <!-- card-body -->
                    </div>
                  <?php endforeach; ?>
                </div>

                <!-- Botón mostrar más. Solo se ve si hay más de 5 items -->
                <?php if ($totalItems > 5): ?>
                  <div class="boton">
                    <button class="btn btn-success ver-mas" data-category="<?php echo $category['idCategoria']; ?>" data-offset="5" data-count="<?php echo $totalItems; ?>">
                      Ver más <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-info ver-menos" style="display: none;" data-category="<?php echo $category['idCategoria']; ?>" data-limit="5">
                      Ver menos <i class="fas fa-minus"></i>
                    </button>
                  </div>
                <?php endif; ?>
                <!-- Botón mostrar más. Solo se ve si hay más de 5 items -->
              <?php else: ?>
                <div class="alert alert-primary" role="alert">No hay ítems disponibles en esta categoría</div>
              <?php endif; ?>
              <!-- Items de la categoría actual -->
            </div>
          <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-primary" role="alert">No hay categorías disponibles</div>
        <?php endif; ?>
      </div>
      <!-- Listado de categorías -->
      
      <!-- Formulario -->
      <div class="col-12 col-lg-4 col-md-5 col-sm-12 col-contenido">
        <div class="formulario">
          <!-- div para almacenar el alert de respuesta -->
          <div class="alertForm"></div>
          <!-- div para almacenar el alert de respuesta -->

          <h3>Formulario</h3>
          <form action="" id="formulario">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" id="name" placeholder="Introduce tu nombre">
            </div>
            <div class="form-group">
              <label for="phone">Teléfono</label>
              <input type="tel" class="form-control" id="phone" placeholder="Introduce tu teléfono">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Introduce tu email">
            </div>
            <div class="form-group">
              <label for="pais">País</label>
              <select class="form-control" id="pais">
                <?php foreach ($paises as $pais): ?>
                  <option value="<?php echo $pais['PAIS_ID'] ?>"><?php echo htmlspecialchars($pais['DESCRIPCION_CORTA']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- Provincias -->
            <div class="form-group" id="prov-container"></div>
            <!-- Provincias -->
            <div class="form-group">
              <label for="cp">C.P.</label>
              <input type="text" class="form-control" id="cp" placeholder="Código postal">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="condiciones">
              <label class="form-check-label" for="condiciones">He leído y aceptado las condiciones legales</label>
            </div>
            <div class="boton">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Formulario -->

    </div>
  </div>
</main>
<aside>
  <div class="container"></div>
</aside>

<?php require 'includes/footer.html'?>