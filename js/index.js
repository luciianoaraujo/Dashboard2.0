

function btnArea(){
    tag = `
    <!-- modal de reclamações -->
  <button type="button" class="m-2 btn btn-primary fixed-bottom" data-toggle="modal" data-target="#exampleModal">
    <i class="far fa-comment-alt"></i>
  </button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dúvidas, criticas e sugestões</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" class="form-group">
              <select name="" id="feedbackOpt" class="form-control mb-2">
                <option value="1">Sugestões</option>
                <option value="2">Dúvidas</option>
                <option value="3">Criticas</option>
              </select>
                <textarea name="" id="feedback" class="form-control" rows="4"></textarea>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
    `
    $('#feedbackArea').append(tag);
}