<?php
  $page_title = 'Lista de districtos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $districts = find_all('districts');
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_district.php" class="btn btn-primary">Agragar districto</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 10%;"> Districto </th>
                <th class="text-center" style="width: 10%;"> Precio delivery </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($districts as $district):?>
              <tr>
                <td class="text-center"><?php echo remove_junk($district['id']);?></td>
                <td> <?php echo remove_junk($district['district_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($district['price_delivery']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_district.php?id=<?php echo (int)$district['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_district.php?id=<?php echo (int)$district['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
