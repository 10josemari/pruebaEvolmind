<?php

// Archivo Database donde tenemos la conexión a nuestra BD
include_once 'Database.php';

// Instancia Database y llamada al método `getConnection` para hacer la conexión
$database = new Database();
$database->getConnection();
