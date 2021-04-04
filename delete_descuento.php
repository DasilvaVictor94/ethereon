<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $descuento = find_by_id('descuentos',(int)$_GET['id']);
  if(!$descuento){
    $session->msg("d","ID vacío");
    redirect('descuentos.php');
  }
?>
<?php
  $delete_id = delete_by_id('descuentos',(int)$descuento['id']);
  if($delete_id){
      $session->msg("s","Descuento eliminado");
      redirect('descuentos.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('descuentos.php');
  }
?>
