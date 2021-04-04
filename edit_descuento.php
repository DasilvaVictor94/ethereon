<?php
  $page_title = 'Editar descuento';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$descuento = find_by_id('descuentos',(int)$_GET['id']);
$all_descuentos = find_all('descuentos');
if(!$descuento){
  $session->msg("d","Missing descuento id.");
  redirect('descuentos.php');
}
?>
<?php
 if(isset($_POST['descuento'])){
    $req_fields = array('d_name','d_descuento');
    validate_fields($req_fields);

   if(empty($errors)){
       $d_name  = remove_junk($db->escape($_POST['d_name']));
       $d_desc   = remove_junk($db->escape($_POST['d_descuento']));

       $query   = "UPDATE descuentos SET";
       $query  .=" name ='{$d_name}', descuento ='{$d_desc}'";
       $query  .=" WHERE id ='{$descuento['id']}';";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Descuento ha sido actualizado. ");
                 redirect('descuentos.php', true);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_descuento.php?id='.$descuento['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_descuento.php?id='.$descuento['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar descuento</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
          <form method="post" action="edit_descuento.php?id=<?php echo (int)$descuento['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="d_name" value="<?php echo remove_junk($descuento['name']);?>">
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="desc">Descuento</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-shopping-cart"></i>
                        </span>
                        <input type="float" class="form-control" name="d_descuento" value="<?php echo remove_junk($descuento['descuento']); ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="descuento" class="btn btn-danger">Actualizar</button>
          </form>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
