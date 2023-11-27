<?php
// sql.php
require_once './config.php';

function connect()
{
    try {
        $connexio = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);

        return $connexio;
    } catch (PDOException $e) {
        // Mostrar errores
        echo "Error: " . $e->getMessage();
    }
}
