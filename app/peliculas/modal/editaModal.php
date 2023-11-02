<div class="modal fade" id="editaModal" tabindex="-1" aria-labelledby="editaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editaModalLabel">Editar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="actualiza.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" id="id" name="id">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion: </label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="genero" class="form-label">Genero: </label>
                        <select name="genero" id="genero" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <?php while ($genero = $generos->fetch_assoc()) { ?>
                                <option value="<?= $genero["id"] ?>"><?= $genero["nombre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <img id="img_poster" width="100">
                    </div>
                    
                    <div class="mb-3">
                        <label for="poster" class="form-label">Poster: </label>
                        <input type="file" name="poster" id="poster" class="form-control" accept="image/jpeg">
                    </div>

                    <div class="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let editaModal = document.getElementById('editaModal');

    editaModal.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');

        let inputId = editaModal.querySelector('.modal-body #id');
        let inputNombre = editaModal.querySelector('.modal-body #nombre');
        let inputDescripcion = editaModal.querySelector('.modal-body #descripcion');
        let inputGenero = editaModal.querySelector('.modal-body #genero');
        let poster = editaModal.querySelector('.modal-body #img_poster');

        let url = "getPelicula.php";
        let formData = new FormData();
        formData.append('id', id);

        fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            inputId.value = data.id;
            inputNombre.value = data.nombre;
            inputDescripcion.value = data.descripcion;
            inputGenero.value = data.id_genero;
            poster.src = '<?= $dir ?>' + data.id + '.jpg';
        }).catch(err => console.log(err));
    });

    editaModal.addEventListener('hide.bs.modal', event => {
        editaModal.querySelector('.modal-body #nombre').value = "";
        editaModal.querySelector('.modal-body #descripcion').value = "";
        editaModal.querySelector('.modal-body #genero').value = "";
        editaModal.querySelector('.modal-body #img_poster').src = "";
        editaModal.querySelector('.modal-body #poster').value = "";
    });

</script>