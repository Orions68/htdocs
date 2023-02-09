<!-- Modal Button, Disclaimer de Empresa. Diálogo que se muestra al registrar una empresa, debe aceptar la política para poder usar el Sitio.-->
<button id="disc" type="button" class="btn btn-primary" style="visibility: hidden;" data-bs-toggle="modal" data-bs-target="#alertDialog1">Diálogo</button>

<!-- Modal -->
<div class="modal fade" id="alertDialog1" tabindex="-1" aria-labelledby="alertDialogLabel1" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="alertDialogLabel1">Dialogo de Avisos</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.open('endsession.php#page_top', '_self')">_</button>
      </div>
      <div class="modal-body">
        <h4><span>Acepta Nuestra Politica de Privacidad</span></h4>
        <h5>Te damos la Bienvenida a Ticket.es</h5>
        <h5>NO USAMOS COOKIES, NO COMPARTIMOS TUS DATOS CON NADIE</h5>
        <h5>Solo recogemos los datos necesarios para que puedas publicar los eventos en este sitio WEB</h5>
        <h5>Eres Libre de eliminar tu perfil en cualquier momento, así como modificar algunos datos.</h5>
        <h5>Tendrás acceso al histórico de tus publicaciones en tu Perfil de Empresa.</h5>
        <h5><span style="color: red">IMPORTANTE:</span> Debes Restar al Menos 4 a la Cantidad de Localidades Dispopnibles.</h5>
        <h5>Si no Aceptas la Política de Ticket.es tu cuenta será borrada en 4 días y se borrarán todos los eventos que hayas publicado</h5>
        <h5>Así mismo perderás la posible recaudación de las entradas vendidas sin derecho a reclamo.</h5>
        <form action="thanks.php" method="post">
          <input type="hidden" name="who" value="comp">
          <input type="hidden" name="id" value="<?php echo $_SESSION['idc']; ?>">
          <label><input type="checkbox" name="accept"> Haz Click en la cajita para aceptar la Politica de la Empresa y después en el botón Acepto.</label>
          <input type="submit" value="Acepto">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" id="close_dialog1" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.open('endsession.php#page_top', '_self')">Cerrar</button>
      </div>
  </div>
  </div>
</div>