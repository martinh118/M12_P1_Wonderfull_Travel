<?php
function connect()
{
    try {
        // $connexio = new PDO('mysql:host=localhost;dbname=wonderfull_travel', 'root', '');
        $connexio = new PDO('mysql:host=localhost;dbname=wonderfull-travel;charset=utf8', 'root', '');

        return $connexio;
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}
