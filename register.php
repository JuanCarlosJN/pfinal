<?php
	include('login.php'); // Includes Login Script

	if(isset($_SESSION['login_user'])){
		header("location: profile.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SirenaMorena: Registro|Login</title>
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
							<li><a href="#">Mi Cuenta</a></li>
							<li><a href="cart.html">Carrito</a></li>
							<li><a href="checkout.html">Checkout</a></li>
							<li><a href="register.php">Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<a href="index.html" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo imgcenter" alt="" height="42" width="110"></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="./products.html">MUJER</a>
							</li>
							<li><a href="./products.html">HOMBRE</a></li>
							<li><a href="./products.html">ACCESORIOS</a>
							</li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>Login || Registro</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span5">
						<h4 class="title"><span class="text"><strong>Login</strong></span></h4>

						<form action="" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Email Address</label>
									<div class="controls">
										<input name="email_log" type="text" placeholder="Escribe tu email registrado" id="name" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input name="password_log" type="password" placeholder="Escribe tu password registrado" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" name="submit" type="submit" value="Login">
									<span>
    									<?php echo $error; ?>
  								</span>
								</div>
							</fieldset>
						</form>

					</div>
					<div class="span7">
						<h4 class="title"><span class="text"><strong>Registro</strong></span></h4>
						<form action="#" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="text" placeholder="Enter your username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Email address:</label>
									<div class="controls">
										<input type="password" placeholder="Enter your email" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password:</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<p>Now that we know who you are. I'm not a mistake! In a comic, you know how you can tell who the arch-villain's going to be?</p>
								</div>
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Create your account"></div>
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
							<li><a href="./index.html">Inicio</a></li>
							<li><a href="./about.html">Acerca de</a></li>
							<li><a href="./contact.html">Contáctanos</a></li>
							<li><a href="./cart.html">Carrito</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>Mi Cuenta</h4>
						<ul class="nav">
							<li><a href="#">Mi Cuenta</a></li>
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
					document.location.href = "checkout.html";
				})
			});
		</script>
    </body>
</html>
