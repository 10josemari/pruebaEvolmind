<?php
/**
 * Helper para el manejo de errores y escritura en log
 * 
 * Este helper maneja la escritura de errores en un archivo log.
 * Crea el archivo y las carpetas si no existen, y escribe el error.
 */

function logError($errorMessage) {
    $logDir = __DIR__ . '/../storage/log';
    $logFile = $logDir . '/log_' . date('Y-m-d') . '.txt';

    // Si el archivo de log no existe, lo creamos y agregamos la cabecera
    if (!file_exists($logFile)) {
        if (false === file_put_contents($logFile, "Log iniciado el " . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND)) {
            die("Error al crear el archivo de log.");
        }
    }

    // Escribimos el error en el archivo log
    if (false === file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $errorMessage . PHP_EOL, FILE_APPEND)) {
        die("Error al escribir en el archivo de log.");
    }
}
