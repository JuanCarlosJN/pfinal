<?php
  function gira(){
    $regreso = '';
    $connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT * FROM producto WHERE almacen_producto>0 ORDER BY almacen_producto DESC");
    $rowspass = 0;
    while($row = mysqli_fetch_array($query)) {
      $id = $row['id_producto'];
      $nombre = $row['nombre_producto'];
      $foto = $row['foto_producto'];
      $precio = $row['precio_producto'];
      if($rowspass==0){
        $regreso = '<div class="active item">
                      <ul class="thumbnails">';
      }
      if($rowspass==4){
        $regreso = $regreso . '<div class="item">
                      <ul class="thumbnails">';
      }
      if($rowspass<8){
        $regreso = $regreso . '
            <li class="span3">
              <div class="product-box">
              <span class="sale_tag"></span>
                <p><a href="product_detail.php?param='.$id.'"><img src="img/'.$foto.'" alt="'.$foto.'" /></a></p>
                  <a href="product_detail.php?param='.$id.'" class="title">'.$nombre.'</a><br/>
                <p class="price">$'.$precio.'</p>
              </div>
            </li>';
      }
      if($rowspass==3 || $rowspass==7){
        $regreso = $regreso . "</ul></div>";
      }
      $rowspass=$rowspass+1;
    }
    mysqli_close($connection);
    return $regreso;
  }

?>
