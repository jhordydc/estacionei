<?php
     session_start();
     include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionario</title>

    <!-- Favicons -->
  <link href="assets/img/sinal-de-estacionamento.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/my-login.css">

</head>
<body class="my-login-page">
    
    <div>
        <h1><?php 
        if (isset($_SESSION['msg'])) {
            echo($_SESSION['msg'] . "<br>");
            unset($_SESSION['msg']);
        }
        ?></h1>
        <a href='lista.php'>Listar Placas</a><br>
        <a href='index_placa.php'>Cadastrar Placas</a><br>
        <a href='login.html'>Sair</a>

    
        <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Cadastro dos Funcionarios</h4>
							<form method="POST" action="cadastro_func.php" class="my-login-validation" novalidate="" >
								<div class="form-group">
									<label for="usuario">Usuario </label>
									<input id="usuario" type="text" class="form-control" name="usuario" value="" required autofocus>
									<div class="invalid-feedback">
										Usuario válido
									</div>
								</div>

								<div class="form-group">
									<label for="password">Senha
									
									</label>
									<input id="senha" type="password" class="form-control" name="senha" required data-eye>
								    <div class="invalid-feedback">
								    	Senha é requerida
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Lembrar-me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Você esqueceu a sua conta? <a href="register.html">Criar uma</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    </div>
</body>
</html>
