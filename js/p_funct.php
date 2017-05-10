<?php
  session_start();

  function showprod($who){
    if($who==''){
      $who=1;
    }
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT * FROM producto WHERE almacen_producto>0 AND categoria=$who ORDER BY id_producto");
    $regreso = ' ';

    while($row = mysqli_fetch_array($query)) {
      $regreso = $regreso .'<li class="span3">
        <div class="product-box">
          <span class="sale_tag"></span>';
      $regreso = $regreso . '<a href="product_detail.php?param='.$row['id_producto'].'"><img alt="'.$row['foto_producto'].'" src="img/'.$row['foto_producto'].'"></a><br/>';
      $regreso = $regreso . '<a href="product_detail.php?param='.$row['id_producto'].'" class="title">'.$row['nombre_producto'].'</a><br/>';
      $regreso = $regreso . '<p class="price">$'.$row['precio_producto'].'</p></div></li>';
    }
    mysqli_close($connection);
    return $regreso;
  }

  function showdetail(){
    $id_prod = $_GET['param'];
    if($id_prod==''){
      $id_prod=1;
    }
    $rdetail = '<div class="span9">
                  <div class="row">
                    <div class="span4">';
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT * FROM producto WHERE id_producto=$id_prod");
    while($row = mysqli_fetch_array($query)) {
      $name = $row['nombre_producto'];
      $descrip = $row['descripcion_producto'];
      $stock = $row['almacen_producto'];
      $precio = $row['precio_producto'];
      $foto = $row['foto_producto'];
    }
    mysqli_close($connection);
    $rdetail = $rdetail . '<a href="img/'.$foto.'" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="'.$foto.'" src="img/'.$foto.'"></a>
              </div>
                <div class="span5">
                  <address>
                    </div>
                    <div class="span5">
                      <address>
                        <strong>Nombre:</strong> <span>'.$name.'</span><br>
                        <strong>Código de Producto:</strong> <span>#'.$id_prod.'</span><br>
                        <strong>En almacen:</strong> <span>'.$stock.'</span><br>
                      </address>
                      <h4><strong>Precio: $'.$precio.'</strong></h4>
                    </div>
                    <div class="span5">';
      if(isset($_SESSION['login_user'])){
    		$rdetail = $rdetail . '<form action="" method="post" class="form-inline">
            <p>&nbsp;</p>
            <label>Cantidad:</label>
            <input name="cadd" type="number" min="1" max="'.$stock.'"class="span1" placeholder="" value="1">
            <input tabindex="9" class="btn btn-inverse large" name="submit_addcart" type="submit" value="Agregar al Carrito">
          </form>';
    	}
      $rdetail = $rdetail . '</div>
                  </div>
                  <div class="row">
                    <div class="span9">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home">Descripción</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="home">'.$descrip.'</div>
                      </div>
                    </div>
                  </div>
                </div>';
      return $rdetail;
  }

  if (isset($_POST['submit_addcart'])){
    $id_prod = $_GET['param'];
    $cantidad = $_POST['cadd'];
    $correo_user= $_SESSION['login_user'];

    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
    while($row = mysqli_fetch_array($query)) {
      $id_user = $row['id_usuario'];
    }
    $valid = mysqli_query($connection, "SELECT * FROM carrito WHERE id_usuario=$id_user AND id_producto=$id_prod");
    $rows = mysqli_num_rows($valid);
    if ($rows == 1) {
      $messaddc = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> El producto ya se encuentra en el carrito.</div>";
    }else{
      $query2 = mysqli_query($connection, "INSERT INTO carrito VALUES ($id_user, $id_prod, $cantidad)");
      $messaddc = "<div class=\"alert alert-success\"><strong>SUCCESS:</strong> Producto agregado al carrito.</div>";
    }
    mysqli_close($connection);
  }
?>
