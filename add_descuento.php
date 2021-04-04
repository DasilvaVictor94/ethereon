<?php
  $page_title = 'Agregar descuento';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
 if(isset($_POST['add_descuento'])){
   $req_fields = array('descuento-titulo','descuento-valor');
   validate_fields($req_fields);
   if(empty($errors)){
     $d_name  = remove_junk($db->escape($_POST['descuento-titulo']));
     $d_val   = remove_junk($db->escape($_POST['descuento-valor']));

     $date    = make_date();
     $query  = "INSERT INTO descuentos (";
     $query .=" name,descuento,date";
     $query .=") VALUES (";
     $query .=" '{$d_name}', '{$d_val}', '{$date}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Descuento agregado exitosamente. ");
       redirect('descuentos.php', true);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('descuentos.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_descuento.php',false);
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
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar descuento</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_descuento.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="descuento-titulo" placeholder="Pack">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <input type="float" min="1" step="any" class="form-control" name="descuento-valor" placeholder="Descuento">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="add_descuento" class="btn btn-danger">Agregar descuento</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
