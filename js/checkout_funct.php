<?php
  function datos($user){
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT * FROM usuario WHERE correo_usuario='$user'");
    while($row = mysqli_fetch_array($query)) {
      $nombre = $row['nombre_usuario'];
      $apellido = $row['apellido_usuario'];
      $fnac = $row['nacimiento_usuario'];
      $direccion = $row['direccion_usuario'];
      $cp = $row['cp_usuario'];
      $tarjeta = $row['tarjeta_usuario'];
    }
    mysqli_close($connection);
    $misdatos= '
        <div class="control-group">
          <label class="control-label">Nombre Completo: '.$nombre.' '.$apellido.'</label>
        </div>
        <div class="control-group">
          <label class="control-label">Fecha de Nacimiento: '.$fnac.'</label>
        </div>
        <div class="control-group">
          <label class="control-label">Email: '.$user.'</label>
        </div>
        <div class="control-group">
          <label class="control-label">Direccion: '.$direccion.'</label>
        </div>
        <div class="control-group">
          <label class="control-label">C.P.: '.$cp.'</label>
        </div>
        <div class="control-group">
          <label class="control-label">Tarjeta: '.$tarjeta.'</label>
        </div>
        ';
    return $misdatos;
  }

  function showcart($correo_user){
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
    while($row = mysqli_fetch_array($query)) {
      $id_user = $row['id_usuario'];
    }
    $query2 = mysqli_query($connection, "SELECT c.id_producto, p.nombre_producto, p.foto_producto, c.num_producto, p.precio_producto, p.almacen_producto
                  FROM producto p, carrito c WHERE id_usuario=$id_user AND p.id_producto=c.id_producto ORDER BY c.id_producto");
      $rcart = '<table id="tablita" class="table table-striped">
        <thead>
          <tr>
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
        $rcart = $rcart . '
          <td><a href="product_detail.php?param='.$ip.'"><img alt="'.$foto.'" src="img/'.$foto.'" width="100"></a></td>
          <td>'.$nombre.'</td>
          <td>'.$cantidad.'</td>
          <td>$'.$precio.'</td>
          <td>$'.$precio*$cantidad.'</td><tr>';
      }
      mysqli_close($connection);
      $rcart = $rcart . '

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
              <hr/>';
      return $rcart;
  }

  if (isset($_POST['submit_import'])) {
    $correo_user=$_SESSION['login_user'];
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
    while($row = mysqli_fetch_array($query)) {
      $id_user = $row['id_usuario'];
    }
    $flag=0;
    $query1 = mysqli_query($connection, "SELECT id_producto, num_producto FROM carrito WHERE id_usuario=$id_user ORDER BY id_producto");
    while($row1 = mysqli_fetch_array($query1)) {
      $idprod = $row1['id_producto'];
      $numprod = $row1['num_producto'];
      $query2 = mysqli_query($connection, "SELECT almacen_producto FROM producto WHERE id_producto=$idprod");
      while($row2 = mysqli_fetch_array($query2)) {
        $stock = $row2['almacen_producto'];
        if ($stock<$numprod){
          $messlog= '<div class="alert alert-warning"><strong>LO SENTIMOS:</strong> No contamos con el stock suficiente para completar la compra. Actualice su carrito e intente de nuevo.</div>';
          $flag= 1;
          break;
        }
      }
    }
    if ($flag==0){
      $total_pedido = '';
      $ptotal_pedido = '';
      $query3 = mysqli_query($connection, "INSERT INTO pedido (ptotal_pedido) VALUES (1)");
      $query4 = mysqli_query($connection, "SELECT id_pedido FROM pedido WHERE ptotal_pedido=1");
      while($row4 = mysqli_fetch_array($query4)) {
        $idpedido = $row4['id_pedido'];
      }
      $query5 = mysqli_query($connection, "SELECT id_producto, num_producto FROM carrito WHERE id_usuario=$id_user ORDER BY id_producto");
      while($row5 = mysqli_fetch_array($query5)) {
        $idprod = $row5['id_producto'];
        $numprod = $row5['num_producto'];
        $ptotal_pedido = $ptotal_pedido + $numprod;
        $query6 = mysqli_query($connection, "SELECT almacen_producto, precio_producto FROM producto WHERE id_producto=$idprod");
        while($row6 = mysqli_fetch_array($query6)) {
          $stock = $row6['almacen_producto'];
          $precio = $row6['precio_producto'];
          $total_pedido = $total_pedido + ($precio*$numprod);
          $newstock = $stock-$numprod;
          $query7 = mysqli_query($connection, "UPDATE producto SET almacen_producto=$newstock WHERE id_producto=$idprod");
        }
        $query8 = mysqli_query($connection, "INSERT INTO historial (id_usuario, id_pedido, id_producto, num_producto) VALUES ($id_user, $idpedido, $idprod, $numprod)");
      }
      $query9 = mysqli_query($connection, "UPDATE pedido SET nart_pedido=$ptotal_pedido, ptotal_pedido=$total_pedido WHERE id_pedido=$idpedido");
      $query10 = mysqli_query($connection, "DELETE FROM carrito WHERE id_usuario=$id_user");
      $messlog= '<div class="alert alert-success"><strong>FELICIDADES:</strong> Tu número de pedido es '.$idpedido.'</div>';
    }
  }

?>
