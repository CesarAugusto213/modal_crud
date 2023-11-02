<?php

$conn = new mysqli("localhost", "root", "mysql", "cinema");

if($conn -> connect_error) {
    die("Error de conexion" . $conn -> connect_error);
}