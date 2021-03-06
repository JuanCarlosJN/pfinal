<?php
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
		<title>SirenaMorena: Contacto</title>
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
			<section class="google_map">
				<iframe width="100%" height="300" src="https://www.maps.ie/create-google-map/map.php?width=100%&amp;height=300&amp;hl=en&amp;coord=20.982261,-89.61819609999998&amp;q=Paseo%20Montejo+(SirenaMorena)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Contáctanos</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span5">
						<div>
							<h5>TANIA NOGUERA GIL</h5>
							<p><strong>Celular:</strong>&nbsp;999-3517204<br>
							<strong>Email:</strong>&nbsp;<a href="#">sirenamorenatg@gmail.com</a>
							</p>
							<br/>
							<h5>VALERIA NOGUERA GIL</h5>
							<p><strong>Celular:</strong>&nbsp;9932-780062<br>
							<strong>Email:</strong>&nbsp;<a href="#">sirenamorenavg@gmail.com</a>
							</p>
						</div>
					</div>
					<div class="span7">
						<p>Para mayores informes, puedes dejarnos un mensaje en el espacio debajo.</p>
						<form method="post" action="#">
							<fieldset>
								<div class="clearfix">
									<label for="name"><span>Nombre:</span></label>
									<div class="input">
										<input tabindex="1" size="18" id="name" name="name" type="text" value="" class="input-xlarge" placeholder="Name">
									</div>
								</div>

								<div class="clearfix">
									<label for="email"><span>Email:</span></label>
									<div class="input">
										<input tabindex="2" size="25" id="email" name="email" type="text" value="" class="input-xlarge" placeholder="Email Address">
									</div>
								</div>

								<div class="clearfix">
									<label for="message"><span>Mensaje:</span></label>
									<div class="input">
										<textarea tabindex="3" class="input-xlarge" id="message" name="body" rows="7" placeholder="Message"></textarea>
									</div>
								</div>

								<div class="actions">
									<button tabindex="3" type="submit" class="btn btn-inverse">ENVIAR</button>
								</div>
							</fieldset>
						</form>
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
