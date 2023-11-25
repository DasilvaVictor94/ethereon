<?php
  $page_title = 'Editar districto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$district = find_by_id('districts',(int)$_GET['id']);
$all_districts = find_all('districts');
if(!$district){
  $session->msg("d","Missing district id.");
  redirect('districts.php');
}
?>
<?php
 if(isset($_POST['edit_district'])){
    $req_fields = array('d_name','d_price');
    validate_fields($req_fields);

   if(empty($errors)){
       $d_name  = remove_junk($db->escape($_POST['d_name']));
       $d_price   = remove_junk($db->escape($_POST['d_price']));

       $query   = "UPDATE districts SET";
       $query  .=" district_name ='{$d_name}', price_delivery ='{$d_price}'";
       $query  .=" WHERE id ='{$district['id']}';";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"El districto ha sido actualizado. ");
                 redirect('districts.php', true);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('edit_district.php?id='.$district['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_district.php?id='.$district['id'], false);
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
            <span>Editar districto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
          <form method="post" action="edit_district.php?id=<?php echo (int)$district['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="d_name" value="<?php echo remove_junk($district['district_name']);?>">
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="dist">Precio</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-shopping-cart"></i>
                        </span>
                        <input type="float" class="form-control" name="d_price" value="<?php echo remove_junk($district['price_delivery']); ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="edit_district" class="btn btn-danger">Actualizar</button>
          </form>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
