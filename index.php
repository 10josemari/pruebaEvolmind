<?php 
  // Cabecera de la página
  require 'includes/header.html';

  // Archivo de conexión para iniciar la conexión a BD
  include_once 'database/DbConnect.php';

  // Includes de controladores
  include_once 'controller/CategoryController.php';

  // Instancias de controladores
  $categoryController = new CategoryController();

  // Llamada al método `listCategories` para devolver la información de todas las categorías
  $categories = $categoryController->listCategories();
?>

<main>
  <div class="container">
    <h1>Título Principal de la Página</h1>
    <div class="row">
      <!-- Listado de categorías -->
      <div class="col-12 col-lg-8 col-md-7 col-sm-12 col-contenido">
        <div class="categoria categoria-1">
          <h2>Título de la categoría 1</h2>
          <div class="card card-a">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-b nueva">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-c">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-a">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-b nueva">
            <?php require 'includes/card.html'?>
          </div>
          <div class="boton">
            <a href="#!" class="btn btn-success">Ver más <i class="fas fa-plus"></i></a>
          </div>
        </div>
        <div class="categoria categoria-2">
          <h2>Título de la categoría 2</h2>
          <div class="card card-b">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-c nueva">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-a">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-b">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-c nueva">
            <?php require 'includes/card.html'?>
          </div>
          <div class="boton">
            <a href="#!" class="btn btn-success">Ver más <i class="fas fa-plus"></i></a>
          </div>
        </div>
        <div class="categoria categoria-3">
          <h2>Título de la categoría 3</h2>
          <div class="card card-a">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-c">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-b nueva">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-a">
            <?php require 'includes/card.html'?>
          </div>
          <div class="card card-c">
            <?php require 'includes/card.html'?>
          </div>
          <div class="boton">
            <a href="#!" class="btn btn-success">Ver más <i class="fas fa-plus"></i></a>
          </div>
        </div>
      </div>
      <!-- Listado de categorías -->
      <div class="col-12 col-lg-4 col-md-5 col-sm-12 col-contenido">
        <div class="formulario">
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
                <option>País 1</option>
                <option>País 2</option>
                <option>País 3</option>
                <option>País 4</option>
                <option>País 5</option>
              </select>
            </div>
            <div class="form-group">
              <label for="prov">Provincia</label>
              <select class="form-control" id="prov">
                <option>Provincia 1</option>
                <option>Provincia 2</option>
                <option>Provincia 3</option>
                <option>Provincia 4</option>
                <option>Provincia 5</option>
              </select>
            </div>
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
    </div>
  </div>
</main>
<aside>
  <div class="container">

  </div>
</aside>

<?php require 'includes/footer.html'?>