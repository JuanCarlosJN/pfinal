<?php
	SESSION_START();
	include('js/checkout_funct.php');
	$manda='';

	if(!isset($_SESSION['login_user'])){
		header("location: register.php");
	}else{
		$correo_user=$_SESSION['login_user'];
		$connection = mysqli_connect("localhost", "juancarlos_jn", "950704", "mydb");
    $query = mysqli_query($connection, "SELECT id_usuario FROM usuario WHERE correo_usuario='$correo_user'");
    while($row = mysqli_fetch_array($query)) {
      $id_user = $row['id_usuario'];
    }
    $query2 = mysqli_query($connection, "SELECT c.id_producto, p.nombre_producto, p.foto_producto, c.num_producto, p.precio_producto, p.almacen_producto
                  FROM producto p, carrito c WHERE id_usuario=$id_user AND p.id_producto=c.id_producto ORDER BY c.id_producto");
    $numrows = mysqli_num_rows($query2);
    if($numrows==0){
			$mess='<div class="alert alert-warning"><strong>INFO:</strong> No tienes nada en el carrito, no se puede hacer checkout.</div>';
		}else{
			$manda='<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"><button class="btn btn-inverse pull-right">Siguiente</button></a>';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SirenaMorena: Checkout</title>
		<link rel="icon" type="image/png" href="img/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">

				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="myaccount.php">Mi Cuenta</a></li>
							<li><a href="cart.php">Carrito</a></li>
							<li><a href="checkout.php">Checkout</a></li>
							<li><a href="js/logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<a href="index.php" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo imgcenter" alt="" height="42" width="110"></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="products.php?param=1">MUJER</a></li>
							<li><a href="products.php?param=2">HOMBRE</a></li>
							<li><a href="products.php?param=3">ACCESORIOS</a></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>CheckOut</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<span>
								<?php if ($messlog!='') {
									echo $messlog;
								} else {
									echo $mess;
								}
								?>
						</span>
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2">Confirma tus datos</a>
								</div>
								<div id="collapseOne" class="accordion-body in collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div id="myDIV" class="span12">
												<?php $datos = datos($_SESSION['login_user']);
															echo $datos;
															echo $manda;
												?>

											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" >Confirma productos:</a>
								</div>
								<div id="collapseTwo" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
										<div id="myDIV" class="span12">
											<?php
												$carro = showcart($correo_user);
												echo $carro;
											?>
											<form id="import_data" action="" method="post"></form>
											<button class="btn pull-right" form="import_data" type="submit" name="submit_import" value="submit_import">Levantar Pedido</button>
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"><button class="btn btn-inverse pull-right">Atrás</button></a>
										</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navegación</h4>
						<ul class="nav">
							<li><a href="./index.php">Inicio</a></li>
							<li><a href="./about.php">Acerca de</a></li>
							<li><a href="./contact.php">Contáctanos</a></li>
							<li><a href="./cart.php">Carrito</a></li>
							<li><a href="./logout.php">Logout</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>Mi Cuenta</h4>
						<ul class="nav">
							<li><a href="myaccount.php">Mi Cuenta</a></li>
							<li><a href="#">Historial de Compras</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						<p>SIRENA MORENA es una marca mexicana de ropa y accesorios hechos a mano.
						Desde la ciudad de Mérida, Yucatán, a todo México.</p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="https://www.facebook.com/Sirena-Morena-1626795787587573/">Facebook</a>
							<a class="instagram" href="https://www.instagram.com/sirenamorena_mx/">Instagram</a>
						</span>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2017 Sirena Morena.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>
