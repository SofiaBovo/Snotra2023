{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
  </div>

  {{-- ---------------------- Delete Modal ---------------------- --}}
  <div class="app-modal" data-name="delete">
      <div class="app-modal-container">
          <div class="app-modal-card" data-name="delete" data-modal='0'>
              <div class="app-modal-header">¿Estás seguro que quieres eliminar esto?</div>
              <div class="app-modal-body">No puedes deshacer esta acción.</div>
              <div class="app-modal-footer">
                  <a href="javascript:void(0)" class="app-btn cancel">Cancelar</a>
                  <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Eliminar</a>
              </div>
          </div>
      </div>
  </div>
  {{-- ---------------------- Alert Modal ---------------------- --}}
  <div class="app-modal" data-name="alert">
      <div class="app-modal-container">
          <div class="app-modal-card" data-name="alert" data-modal='0'>
              <div class="app-modal-header"></div>
              <div class="app-modal-body"></div>
              <div class="app-modal-footer">
                  <a href="javascript:void(0)" class="app-btn cancel">Cancelar</a>
              </div>
          </div>
      </div>
  </div>
