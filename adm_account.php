<?php
	include('js/adm_function.php');
	session_start();

	if(!isset($_SESSION['login_adm'])){
		header("location: adm_register.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SirenaMorena: Cuenta del Administrador</title>
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
							<li><a href="js/adm_logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<img src="themes/images/logo.png" class="site_logo imgcenter" alt="" height="42" width="110">
					<nav id="menu" class="pull-right">
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
				<h4><span>ADMINISTRACIÓN DE SIRENA MORENA</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a name="inventario" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Productos en Inventario</a>
								</div>
								<div id="collapseOne" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div id="myDIV" class="span12">
			    								<?php $stock = inventario();
																echo $stock;
													?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a name="inventario" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Historial de Compras en SM</a>
								</div>
								<div id="collapseTwo" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div id="myDIV" class="span12">
			    								<?php $sales = historialTEST2();
																echo $sales;
													?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Agregar Nuevos Productos</a>
								</div>
								<div id="collapseThree" class="accordion-body <?php echo $manten ?> collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span7">
												<h4>Datos del Nuevo Producto</h4>
												<form action="#" method="post" class="form-stacked">
													<fieldset>
														<div class="control-group">
															<label class="control-label">Nombre: </label>
															<div class="controls">
																<input name="n_prod" maxlength="60" type="text" placeholder="Menor a 60 caracteres" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Descripción: </label>
															<div class="controls">
																<input name="d_prod" maxlength="150" type="text" placeholder="Menor a 150 caracteres" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Precio: </label>
															<div class="controls">
																<input name="p_prod" min="0" max="99999" type="number" step="0.01" placeholder="Ej. 20.50" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Almacen: </label>
															<div class="controls">
																<input name="a_prod" min="0" max="99999" type="number" placeholder="Ej. 15" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Categoria: </label>
															<div class="controls">
																<input name="c_prod" min="1" max="3" type="number" placeholder="1=MUJER 2=HOMBRE 3=ACCESORIO" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Fotografía: </label>
															<div class="controls">
																<input name="f_prod" maxlength="45" type="text" placeholder="Ej. foto.jpg" class="input-xlarge">
															</div>
														</div>
														<div class="actions">
															<input tabindex="9" class="btn btn-inverse large" name="submit_add" type="submit" value="Agregar a Catalogo"><br><br>
														</div>
													</fieldset>
												</form>
											</div>
											<div class="span5">
												<span>
														<?php echo $messadd; ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">Modificar Productos</a>
								</div>
								<div id="collapseFour" class="accordion-body <?php echo $manten2 ?> collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<?php echo $relleno?>
											<span>
													<?php echo $messmod; ?>
											</span>
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
					<div class="span7">
						<h4>Navegación</h4>
						<ul class="nav">
							<li><a href="js/adm_logout.php">Logout</a></li>
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
