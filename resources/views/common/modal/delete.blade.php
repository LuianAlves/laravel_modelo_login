<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModal" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Alerta de atenção!</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="fa-solid fa-bell fs-1 text-gradient text-bg-warning"></i>
                    <h4 class="text-gradient text-dark mt-4">Você tem certeza?</h4>
                    <p class="mx-2">Após a exclusão todos os registros relacionados serão removido. Não há como refazer essa ação!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm bg-gradient-dark text-white ml-auto" data-bs-dismiss="modal">Não</button>
                <button type="button" class="btn btn-sm bg-gradient-warning" id="confirmDelete">Sim, excluir registro!</button>
            </div>
        </div>
    </div>
</div>
