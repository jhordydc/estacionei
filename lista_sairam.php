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
        <title>Cadastro Placas</title>
    
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
        <?php 
        if (isset($_SESSION['msg'])) {
            echo($_SESSION['msg'] . "<br>");
            unset($_SESSION['msg']);
        }
        ?>
            <a href='lista.php'>Listar Placas</a>
            <section class="h-100">
		    <div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">

        <?php
                    // contagem do número de vagas
                    $result_carros = "SELECT COUNT(id) AS qt_ativos FROM veiculo WHERE estacionado = 1";
                    $resultado_carros = mysqli_query($conn, $result_carros);
                    $ativos = mysqli_fetch_assoc($resultado_carros);

                    // receber o número da página
                    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                    // setar a quantidade de itens por pagina
                    $qnt_result_pg = 5;

                    // calcular o início visualização(??)
                    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                    $result_usuarios = "SELECT * FROM veiculo WHERE estacionado = 0 LIMIT $inicio, $qnt_result_pg";
                    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

                    echo("<br><h4><a href='index_placa.php'>Cadastrar Placa</a></h4>");
                    echo("<h4><a href='lista.php'>Carros estacionados</a></h4>");
                    if (isset($_SESSION['faturamento'])) {
                        echo ("<h6>faturamento do dia: R$" . $_SESSION['faturamento'] . "</h6>");
                    }
                    else {
                        echo ("<h6>faturamento do dia: R$00.00</h6> <br>");
                    }
                    if (isset($_SESSION['carrosDia'])) {
                        echo ("<h6>carros estacionados no dia:" . $_SESSION['carrosDia'] . "</h6>");
                    }
                    echo ("<h6>Vagas disponíveis:" . (200 - $ativos['qt_ativos']) . "</h6>");
                    echo("<a href='login.html'>Sair</a><br>");
                    while ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
                        $novaData = date("d-m-Y", strtotime($row_usuario['data_cadastro']));
                        echo "<h3>ID: " . $row_usuario['id'] . "</h3>";
                        echo "<p>Placa: " . $row_usuario['placa'] . "</p>";
                        echo "<p>Data de Cadastro: " . $novaData . "</p>";
                        echo "<p>Horario de Saída: " . $row_usuario['horario_saida'] . "</p>";
                    }

                    // Paginação - Somar a quantidade de usuários
                    $result_pg = "SELECT COUNT(id) AS num_result FROM veiculo WHERE estacionado = 0";
                    $resultado_pg = mysqli_query($conn, $result_pg);
                    $row_pg = mysqli_fetch_assoc($resultado_pg);

                    // quantidade de páginas
                    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
                    // limitar a quantidade de paginas que aparece
                    $max_links = 2;
                    echo '<br><br><a href="./lista_sairam.php?pagina=1">Primeira</a> ';
                    // mostrar a página a partir de 2 a menos até ser igual ao número da página atual - 1 (navegação)
                    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                        if ($pag_ant >= 1) {
                            echo "<a href='lista_sairam.php?pagina=$pag_ant'>$pag_ant</a> ";
                        }
                    }

                    echo "$pagina ";
                    // mostrar a página a partir do número da página atual + 1 até 2 a mais (navegação)
                    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                        if ($pag_dep <= $quantidade_pg) {
                            echo "<a href='lista_sairam.php?pagina=$pag_dep'>$pag_dep</a> ";
                        } 
                    }

                    echo "<a href='./lista_sairam.php?pagina=$quantidade_pg'>Última</a>";
                ?>