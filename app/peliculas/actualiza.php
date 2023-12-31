<?php

session_start();

require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$genero = $conn->real_escape_string($_POST['genero']);

$sql = "UPDATE pelicula 
        SET nombre = '$nombre',
            descripcion = '$descripcion',
            id_genero = '$genero'
        WHERE id = $id";

if ($conn->query($sql)) {
    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Registro actualizado.";

    if ($_FILES['poster']['error'] == UPLOAD_ERR_OK) {
        $permitidos = array("image/jpg", "image/jpeg");

        if (in_array($_FILES['poster']['type'], $permitidos)) {
            $dir = "posters";

            $info_img = pathinfo($_FILES['poster']['name']);

            $poster = $dir . '/' . $id . "." . $info_img['extension'];

            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }

            if (!move_uploaded_file($_FILES['poster']['tmp_name'], $poster)) {
                $_SESSION['color'] = "danger";
                $_SESSION['msg'] .= "<br>Error al actualizar imagen.";
            }
        } else {
            $_SESSION['color'] = "danger";
            $_SESSION['msg'] .= "<br>Formato de imagen no permitido.";
        }
    }
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al actualizar imagen.";
}

header('Location: index.php');
