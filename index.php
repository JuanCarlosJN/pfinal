<?php
	include('js/index_func.php');
	$logstatus = '';
	session_start(); // Includes Login Script

	if(!isset($_SESSION['login_user'])){
		$logstatus = "Login";
	}else{
		$logstatus = "Logout";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SirenaMorena</title>
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
							<li><?php if($logstatus=="Logout"){
												echo "<a href=\"js/logout.php\">Logout</a></li>";
											}else{
												echo "<a href=\"register.php\">Login</a></li>";
											}?>
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
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/banner-1.png" alt="" />
						</li>
						<li>
							<img src="themes/images/carousel/banner-2.png" alt="" />
							<div class="intro">
								<h1>SirenaMorena.com</h1>
								<p><span>¡Bienvenido a</span></p>
								<p><span>una nueva forma de ser Sirena!</span></p>
							</div>
						</li>
					</ul>
				</div>
			</section>
			<section class="header_text">
				SIRENA MORENA es una marca mexicana de ropa y accesorios hechos a mano.</br>
				Desde la ciudad de Mérida, Yucatán, a todo México.
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Algunos <strong>Productos</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<?php
											$gira = gira();
											echo $gira;
										?>
									</div>
								</div>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line">Ultimas <strong>Noticias</strong></span></span></span>
								</h4>
								<div align="center" id="myCarousel-2" class="myCarousel carousel slide" >
									<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FSirena-Morena-1626795787587573%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
								</div>
							</div>
						</div>
						<div class="row feature_box">
							<div class="span4">
								<div class="service">
									<div class="responsive">
										<img src="themes/images/feature_img_2.png" alt="" />
										<h4>DISEÑOS <strong>MODERNOS</strong></h4>
										<p>Una nueva forma de usar materiales 100% mexicanos.</p>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="service">
									<div class="customize">
										<img src="themes/images/feature_img_1.png" alt="" />
										<h4>ENVIOS <strong>A TODO MEXICO</strong></h4>
										<p>Te enviamos tus productos SM a cualquier parte de la República Mexicana.</p>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="service">
									<div class="support">
										<img src="themes/images/feature_img_3.png" alt="" />
										<h4>COMPRAS <strong>24/7</strong></h4>
										<p>Puedes comprar online a cualquier hora los 365 días del año.</p>
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
							<li><?php if($logstatus=="Logout"){
												echo "<a href=\"js/logout.php\">Logout</a></li>";
											}else{
												echo "<a href=\"register.php\">Login</a></li>";
											}?>
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
							<a class="facebook" href="https://www.facebook.com/Sirena-Morena-1626795787587573/"><span class="social social-facebook"></span></a>
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
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>
