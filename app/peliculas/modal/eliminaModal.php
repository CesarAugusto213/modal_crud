<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminaModalLabel">Eliminar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar el registro?</p>
            </div>
            <div class="modal-footer">
                <form action="elimina.php" method="POST">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let eliminaModal = document.getElementById('eliminaModal');

    eliminaModal.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');

        eliminaModal.querySelector('.modal-footer #id').value = id;
    });
</script>