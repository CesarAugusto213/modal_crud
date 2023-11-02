<?php

session_start();

require '../config/database.php';

$sqlPeliculas = "SELECT p.id, p.nombre, p.descripcion, g.nombre as genero 
                FROM pelicula AS p 
                INNER JOIN genero AS g
                ON p.id_genero = g.id";

$peliculas = $conn->query($sqlPeliculas);

$dir = "posters/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Modal</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../assets/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container py-3">
        <h2 class="text-center">Peliculas</h2>

        <hr>

        <?php
        if (isset($_SESSION['msg']) && isset($_SESSION['color'])) {
        ?>
            <div class="alert alert-<?= $_SESSION['color'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['msg']);
            unset($_SESSION['color']);
        }
        ?>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    <i class="fa-solid fa-circle-plus"></i> Nuevo Registro
                </a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Genero</th>
                    <th>Poster</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pelicula = $peliculas->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $pelicula["id"] ?></td>
                        <td><?= $pelicula["nombre"] ?></td>
                        <td><?= $pelicula["descripcion"] ?></td>
                        <td><?= $pelicula["genero"] ?></td>
                        <td><img src="<?= $dir . $pelicula["id"] . ".jpg?n=" . time(); ?>" width="50"></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $pelicula["id"]; ?>">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $pelicula["id"]; ?>">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        $sqlGenero = "SELECT id, nombre FROM genero";
        $generos = $conn->query($sqlGenero);
        ?>

        <?php include './modal/nuevoModal.php'; ?>

        <?php $generos->data_seek(0) ?>

        <?php include './modal/editaModal.php'; ?>

        <?php include './modal/eliminaModal.php'; ?>

    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>