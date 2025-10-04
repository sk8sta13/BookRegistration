<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja <b>DELETAR</b> permanentemente o registro: <strong id="deleteRecordName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, Cancelar</button>
                <button type="submit" class="btn btn-danger" id="confirmDeleteButton">Sim, Deletar</button>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" action="">
    @csrf
    @method('DELETE')
</form>

@section('js')
    <script>
        $(document).ready(function() {
            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var route = button.data('route');
                var name = button.data('name');
                var modal = $(this);
                var form = $('#deleteForm');
            
                modal.find('#deleteRecordName').text(name);
                form.attr('action', route);
            });

            $('#confirmDeleteButton').on('click', function() {
                $('#deleteForm').submit();
            });
        });
    </script>
@stop