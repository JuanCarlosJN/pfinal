<?php
  function showcart($correo_user){
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
    while($row = mysqli_fetch_array($query)) {
      $id_user = $row['id_usuario'];
    }
    $query2 = mysqli_query($connection, "SELECT c.id_producto, p.nombre_producto, p.foto_producto, c.num_producto, p.precio_producto, p.almacen_producto
                  FROM producto p, carrito c WHERE id_usuario=$id_user AND p.id_producto=c.id_producto ORDER BY c.id_producto");
    $numrows = mysqli_num_rows($query2);
    if($numrows>0){
      $rcart = '<table id="tablita" class="table table-striped">
        <thead>
          <tr>
            <th>Seleccionar</th>
            <th>Imagen</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <form id="cartmodif" action="" method="post">
          <tr>';
      while($row2 = mysqli_fetch_array($query2)) {
        $idp = $row2['id_producto'];
        $nombre = $row2['nombre_producto'];
        $foto = $row2['foto_producto'];
        $cantidad = $row2['num_producto'];
        $precio = $row2['precio_producto'];
        $stock = $row2['almacen_producto'];
        $pfinal = $pfinal + ($precio*$cantidad);
        $rcart = $rcart . '<td><input type="radio" name="modifica" value="'.$idp.'" class="input-xlarge"></td>
          <td><a href="product_detail.php?param='.$idp.'"><img alt="'.$foto.'" src="img/'.$foto.'" width="100"></a></td>
          <td>'.$nombre.'</td>
          <td><input name="'.$idp.'" type="number" min="1" max="'.$stock.'"class="span1" placeholder="" value="'.$cantidad.'"></td>
          <td>$'.$precio.'</td>
          <td>$'.$precio*$cantidad.'</td><tr>';
      }
      mysqli_close($connection);
      $rcart = $rcart . '
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong>$'.$pfinal.'</strong></td>
                  </tr>
                  </form>
                </tbody>
              </table>
              <hr>
  						<p class="cart-total right">
  							<strong>Sub-Total</strong>:	$'.number_format((float)$pfinal/1.16, 2, '.', '').'<br>
  							<strong>IVA (16%)</strong>: $'.number_format((float)$pfinal-($pfinal/1.16), 2, '.', '').'<br>
  							<strong>Total</strong>: $'.$pfinal.'<br>
  						</p>
              <hr/>
              <p class="buttons center">
                <button class="btn" form="cartmodif" type="submit" name="submit_upd" value="submit_upd">Actualizar</button>
  							<button class="btn" form="cartmodif" type="submit" name="submit_elim" value="submit_elim">Eliminar</button>

  							<button class="btn btn-inverse" type="submit" id="checkout">Ir a Checkout</button>
  						</p>';
      return $rcart;
    }else{
      $rcart = '<div class="alert alert-info"><strong>TIP:</strong> Agrega productos al carrito para poder comprar.</div>';
      return $rcart;
    }
  }

  if (isset($_POST['submit_elim'])) {
    if(isset($_POST['modifica']) && isset($_SESSION['login_user'])){
      $correo_user = $_SESSION['login_user'];
      $idelim = $_POST['modifica'];
      $iduser = '';
      $con = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
      $que= mysqli_query($con, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
      while($r = mysqli_fetch_array($que)) {
        $iduser = $r['id_usuario'];
      }
      $que= mysqli_query($con, "DELETE FROM carrito WHERE id_usuario=$iduser AND id_producto=$idelim");
      mysqli_close($con);
      $messlog = '<div class="alert alert-success"><strong>SUCCESS:</strong> Se eliminó del carrito el producto seleccionado.</div>';
    }
  }

  if (isset($_POST['submit_upd'])) {
    if(isset($_POST['modifica']) && isset($_SESSION['login_user'])){
      $correo_user = $_SESSION['login_user'];
      $idelim = $_POST['modifica'];
      $qup = $_POST[$_POST['modifica']];
      $con = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
      $que= mysqli_query($con, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
      while($r = mysqli_fetch_array($que)) {
        $iduser = $r['id_usuario'];
      }
      $que= mysqli_query($con, "UPDATE carrito SET num_producto=$qup WHERE id_usuario=$iduser AND id_producto=$idelim");
      //mysqli_close($con);
      $messlog = '<div class="alert alert-success"><strong>SUCCESS:</strong> Se actualizó la cantidad de productos.</div>';
    }
  }
?>
