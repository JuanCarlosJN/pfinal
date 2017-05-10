<?php
  session_start(); // Starting Session
  $stock = $sales = $messadd = $manten = '';

  function inventario() {
    $regreso = '';
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_producto, nombre_producto, almacen_producto, nombre_categoria FROM producto p, categoria c WHERE c.id_categoria=p.categoria");
    $regreso = "<table id=\"tablita\" class=\"table table-responsive\"><thead>
    <tr>
    <th>CÓDIGO</th>
    <th>PRODUCTO</th>
    <th>ALMACEN</th>
    <th>CATEGORIA</th>
    </tr></thead><tbody>";

    while($row = mysqli_fetch_array($query)) {
      $regreso = $regreso . "<tr>";
      $regreso = $regreso . "<td>" . $row['id_producto'] . "</td>";
      $regreso = $regreso . "<td>" . $row['nombre_producto'] . "</td>";
      $regreso = $regreso . "<td>" . $row['almacen_producto'] . "</td>";
      $regreso = $regreso . "<td>" . $row['nombre_categoria'] . "</td>";
      $regreso = $regreso . "</tr>";
    }

    $regreso = $regreso . "</tbody></table>";
    mysqli_close($connection);
    return $regreso;
  }

  function historialTEST2(){
    $r2 = '';
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query1 = mysqli_query($connection, "SELECT id_pedido FROM pedido ORDER BY id_pedido");
    $r2 = "<table id=\"tablita\" class=\"table table-responsive\"><thead>
    <tr>
    <th>PEDIDO</th>
    <th>PRODUCTO-CANTIDAD</th>
    <th>TOTAL</th>
    </tr></thead><tbody>";
    $query2 = mysqli_query($connection, "SELECT DISTINCT h.id_pedido, p.ptotal_pedido FROM historial h, pedido p WHERE p.id_pedido=h.id_pedido ORDER BY h.id_pedido");
    $comprado = "<table id=\"tablita\" class=\"table table-striped table-responsive\"><thead>
      <tr>
      <th>PEDIDO</th>
      <th>PRODUCTO-CANTIDAD</th>
      <th>TOTAL</th>
      </tr></thead><tbody>";
    while($row2 = mysqli_fetch_array($query2)) {
      $idpedido = $row2['id_pedido'];
      $preciototal = $row2['ptotal_pedido'];
      $query3 = mysqli_query($connection, "SELECT p.nombre_producto, h.num_producto FROM producto p, historial h WHERE h.id_pedido=$idpedido AND h.id_producto=p.id_producto");
      $rowq = mysqli_num_rows($query3);
      $comprado = $comprado . "<tr>";
      $comprado = $comprado . "<td>" . $idpedido . "</td><td><ul>";
      while($row3 = mysqli_fetch_array($query3)){
        $comprado = $comprado . "<li>" . $row3['nombre_producto'] . ": " . $row3['num_producto'] . " piezas</li>";
      }
      $comprado = $comprado . "</ul><td>$".$preciototal."</td></tr>";
    }
    $comprado = $comprado . "</tbody></table>";
    mysqli_close($connection);
    return $comprado;
  }

  if (isset($_POST['submit_add'])){
    $nombre = $_POST["n_prod"];
    $descripcion = $_POST["d_prod"];
    $precio = $_POST["p_prod"];
    $almacen = $_POST["a_prod"];
    $categoria = $_POST["c_prod"];
    $foto = $_POST["f_prod"];

    if (empty($_POST['n_prod']) || empty($_POST['d_prod']) || empty($_POST['p_prod']) || empty($_POST['a_prod'])
          || empty($_POST['c_prod']) || empty($_POST['f_prod'])) {
      // verificar si los campos no estan en blanco
      $messadd = "<div class=\"alert alert-danger\"><strong>ERROR:</strong> Rellena todos los campos.</div>";
      $manten = "in";
    }else{
      $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
      $queryadd = mysqli_query($connection, "INSERT INTO producto (nombre_producto, descripcion_producto,
          precio_producto, almacen_producto, categoria, foto_producto) VALUES ('$nombre', '$descripcion',
          $precio, $almacen, $categoria, '$foto')");
      mysqli_close($connection);
      $messadd = "<div class=\"alert alert-success\"><strong>FELICIDADES:</strong> Producto agregado al catalogo.</div>";
      $manten = "in";
    }
  }

  $relleno = "
  <form action=\"#\" method=\"post\" class=\"form-stacked\">
    <fieldset>
      <div class=\"control-group\">
        <label class=\"control-label\">Selecciona el producto a modficar: </label>
        <div class=\"controls\">
        <select name=\"paso\">";
  $connectionmod = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
  $querymod = mysqli_query($connectionmod, "SELECT id_producto, nombre_producto FROM producto ORDER BY id_producto");
  while($rowmod = mysqli_fetch_array($querymod)) {
    $relleno = $relleno . "<option value=\"" . $rowmod['id_producto'] . "\">"  . $rowmod['nombre_producto'] . "</option>";
  }
  mysqli_close($connectionmod);
  $relleno = $relleno ."</select>
                      </div>
                      <div class=\"actions\">
                        <input tabindex=\"9\" class=\"btn btn-inverse large\" name=\"submit_mod\" type=\"submit\" value=\"Modificar\"><br><br>
                      </div>
                    </div>
                    </fieldset>
                  </form>";

  if (isset($_POST['submit_mod'])){
    $id_modif= $_POST['paso'];
    $connectionmod2 = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $querymod2 = mysqli_query($connectionmod2, "SELECT * FROM producto WHERE id_producto='$id_modif' ORDER BY id_producto");
    while($rowmod2 = mysqli_fetch_array($querymod2)) {
      $np = $rowmod2['nombre_producto'];
      $dp = $rowmod2['descripcion_producto'];
      $pp = $rowmod2['precio_producto'];
      $ap = $rowmod2['almacen_producto'];
      $catp = $rowmod2['categoria'];
      $fp = $rowmod2['foto_producto'];
    }
    mysqli_close($connectionmod2);

    $relleno= '<div class="span7">
      <h4>Modificación del Producto</h4>
      <form action="#" method="post" class="form-stacked">
        <fieldset>
          <div class="control-group">
            <label class="control-label">Id: </label>
            <div class="controls">
              <input name="i_p" type="radio" placeholder="" value="'.$id_modif.'" class="input-xlarge" checked> '. $id_modif .'<br>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Nombre: </label>
            <div class="controls">
              <input name="n_p" maxlength="60" type="text" placeholder="'.$np.'" value="'.$np.'" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Descripción: </label>
            <div class="controls">
              <input name="d_p" maxlength="150" type="text" placeholder="'.$dp.'" value="'.$dp.'" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Precio: </label>
            <div class="controls">
              <input name="p_p" min="0" max="99999" type="number" step="0.01" placeholder="'.$pp.'" value="'.$pp.'" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Almacen: </label>
            <div class="controls">
              <input name="a_p" min="0" max="99999" type="number" placeholder="'.$ap.'" value="'.$ap.'" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Categoria: </label>
            <div class="controls">
              <input name="c_p" min="1" max="3" type="number" placeholder="'.$catp.'" value="'.$catp.'" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Fotografía: </label>
            <div class="controls">
              <input name="f_p" maxlength="45" type="text" placeholder="'.$fp.'" value="'.$fp.'" class="input-xlarge">
            </div>
          </div>
          <div class="actions">
            <input tabindex="9" class="btn btn-inverse large" name="submit_mod2" type="submit" value="Modificar Producto"><br><br>
          </div>
        </fieldset>
      </form>
    </div>
    <div class="span5">
      <span>
          <?php echo $messmod; ?>
      </span>
    </div>';
    $messmod = " ";
    $manten2 = "in";
  }

  if (isset($_POST['submit_mod2'])){
    $id_modif = $_POST['i_p'];
    $n_modif = $_POST['n_p'];
    $d_modif = $_POST['d_p'];
    $p_modif = $_POST['p_p'];
    $a_modif = $_POST['a_p'];
    $c_modif = $_POST['c_p'];
    $f_modif = $_POST['f_p'];

    $connectionmod3 = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $querymod3 = mysqli_query($connectionmod3, "UPDATE producto SET nombre_producto='$n_modif', descripcion_producto='$d_modif',
                    precio_producto=$p_modif, almacen_producto=$a_modif, categoria=$c_modif, foto_producto='$f_modif'
                    WHERE id_producto=$id_modif");
    mysqli_close($connectionmod3);
    $messmod = "<div class=\"alert alert-success\"><strong>SUCCESS:</strong> Producto modificado.</div>";
    $manten2 = "in";
  }
