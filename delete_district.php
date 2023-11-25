<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $district = find_by_id('districts',(int)$_GET['id']);
  if(!$district){
    $session->msg("d","ID vacío");
    redirect('districts.php');
  }
?>
<?php
  $delete_id = delete_by_id('districts',(int)$district['id']);
  if($delete_id){
      $session->msg("s","Districto eliminado");
      redirect('districts.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('districts.php');
  }
?>
