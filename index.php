<?php include('conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Evaluacion</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="javascript:gesmenu()" data-toggle="tooltip" data-placement="bottom" title="ABC Menus">Evaluacion</a>
  <script>
    function gesmenu(){
      $("#abcmenus").show();
      $("#descmenus").hide();
    }
  </script>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
        $sql = mysqli_query($conn, "SELECT * FROM menus WHERE mn_depen IS NULL") or die('error'.mysqli_error($conn));
        while($data = mysqli_fetch_assoc($sql)){
          $sq = mysqli_query($conn, "SELECT * FROM menus WHERE mn_depen='$data[idmenus]'") or die('error'.mysqli_error($conn));
          if (mysqli_num_rows($sq)>0) {
            echo "<li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' href='#' role='button' data-toggle='dropdown' aria-expanded='false'>
                    $data[mn_name]
                  </a>
                  <div class='dropdown-menu'>";
                  while($dato = mysqli_fetch_assoc($sq)){
                    echo "<a class='dropdown-item' href='javascript:descrip($dato[idmenus])'>$dato[mn_name]</a>";
                  }
            echo "</div></li>";
          }else{
            echo"<li class='nav-item'>
                    <a class='nav-link' href='javascript:descrip($data[idmenus])'>$data[mn_name] <span class='sr-only'>(current)</span></a>
                  </li>";
          }
        }
      ?>
    </ul>
  </div>
</nav>
    <div class="text-md-center" style='display:none' id="descmenus"></div>
    <div class="text-md-center col-md-12">
      <?php
        if (empty($_GET['alert'])) {
          echo "";
        }elseif ($_GET['alert'] == 1) {
          echo "<div class='alert alert-success' role='alert'>
                  Accion realizada con exito!!!
                </div>";
        }elseif ($_GET['alert'] == 2) {
          echo "<div class='alert alert-danger' role='alert'>
                  El menu que intenta agregar ya existe!!!
                </div>";
        }elseif ($_GET['alert'] == 3) {
          echo "<div class='alert alert-danger' role='alert'>
                  Se produjo un error al agregar el menu, por favor vuelva a intentarlo!!!
                </div>";
        }elseif ($_GET['alert'] == 4) {
          echo "<div class='alert alert-danger' role='alert'>
                  Se produjo un error al editar el menu, por favor vuelva a intentarlo!!!
                </div>";
        }elseif ($_GET['alert'] == 5) {
          echo "<div class='alert alert-success' role='alert'>
                  Se elimino el menu con exito!!!
                </div>";
        }elseif ($_GET['alert'] == 6) {
          echo "<div class='alert alert-danger' role='alert'>
                  Se produjo un error al eliminar el menu, por favor vuelva a intentarlo!!!
                </div>";
        }
      ?>
    </div>
    <div style='display:none' id="abcmenus">
      <div class="container-fluid">
      <section class='col-lg-12'>
        <div class='card'>
          <h5 class='card-header bg-primary'>
            Menu
              <a type="button" href="javascript:selectmodal('0','modmenu','add')" class="btn btn-success btn-sm float-right"><i class="fa-solid fa-plus"></i> Nuevo</a>
          </h5>
          <div class='card-body table-responsive'>
            <table class='compact table-striped table-bordered' cellspacing='0' style='width:100%'>
              <thead>
                <tr align='center'>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Menu Padre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT menus.idmenus,menus.mn_name,menus.mn_descrip,mn1.mn_name AS mn_padre FROM menus LEFT JOIN menus mn1 ON menus.mn_depen = mn1.idmenus ORDER BY idmenus ASC";
                  $resultadoM = mysqli_query($conn, $query) or die('error'.mysqli_error($conn));
                  while($data = $resultadoM->fetch_assoc()){
                    echo "<tr>
                            <td align='center'>$data[idmenus]</td>
                            <td align='center'>$data[mn_name]</td>
                            <td align='center'>$data[mn_padre]</td>
                            <td align='center'>$data[mn_descrip]</td>
                            <td align='center'>";
                            ?>
                              <a type="button" href="javascript:selectmodal('<?php echo $data['idmenus']?>','modmenu','edit')" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i> Editar</a>
                            <?php
                    echo "    <a type='button' class='btn btn-danger btn-sm' href='operaciones.php?Action=del&id=$data[idmenus]'>
                                <i class='fa-solid fa-trash'></i> Eliminar
                              </a>
                            </td>
                          </tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
    </div>
    <div class="modal fade" id="modmenu" role="dialog" aria-labelledby="datosAd" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          </div>
        </div>
      </div>
    <script src="jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
    <script type="text/javascript">
        function selectmodal(id,modal,action){  
        $('.modal-content').load('select_modal.php?id='+id+'&my_modal='+modal+'&Action='+action,function(){
          $('#'+modal+'').modal({show:true});
        });
      }
      </script>
      <script>
        function descrip(idm){
          var datos = {"id":idm};
          $("#descmenus").show();
          $("#abcmenus").hide();
          $.ajax({
            data: datos,
            url: "getMenus.php",
            type: "POST",
            success: function(data){
              $("#descmenus").html(data);
            }
          });
        }
      </script>
	</body>
</html>