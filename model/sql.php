<?php
function connect()
{
    try {
        $connexio = new PDO('mysql:host=localhost;dbname=wonderfull_travel', 'root', '');
        //echo "Connexio correcta!!" . "<br />";
        return $connexio;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}
