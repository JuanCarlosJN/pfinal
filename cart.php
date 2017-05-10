<?php
	SESSION_START();
	include('js/cart_funct.php');

	if(!isset($_SESSION['login_user'])){
		header("location: register.php");
	}else{
		$correo_user=$_SESSION['login_user'];
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SirenaMorena: Carrito de Compras</title>
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
			<script src="themes/js/respond.min.js"></script>
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
				<h4><span>Carrito de Compras</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div id="myDIV" class="span9">
						<h4 class="title"><span class="text"><strong>Mi</strong> Carrito</span></h4>
						<span>
								<?php echo $messlog; ?>
						</span>
						<?php
							$carro = showcart($correo_user);
							echo $carro;
						?>

					</div>
					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<li class="nav-header">CATEGORIAS</li>
								<li><a href="products.php?param=1">MUJER</a></li>
								<li><a href="products.php?param=2">HOMBRE</a></li>
								<li><a href="products.php?param=3">ACCESORIOS</a></li>
							</ul>
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
							<li><a href="js/logout.php">Logout</a></li>
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
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.php";
				})
			});
		</script>
    </body>
</html>
