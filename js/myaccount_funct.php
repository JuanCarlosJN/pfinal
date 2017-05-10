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
   $misdatos= '<h4>Datos del usuario</h4>
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

 function historial($email){
   $comprado = '';
   $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
   $query1 = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$email'");
   while($row1 = mysqli_fetch_array($query1)) {
     $id = $row1['id_usuario'];
   }
   $query2 = mysqli_query($connection, "SELECT DISTINCT h.id_pedido, p.ptotal_pedido FROM historial h, pedido p WHERE id_usuario=$id AND p.id_pedido=h.id_pedido ORDER BY h.id_pedido");
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

?>
