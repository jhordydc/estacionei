<?php
    session_start();
    include_once("conexao.php");
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
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
        <h1><?php 
        if (isset($_SESSION['msg'])) {
            echo($_SESSION['msg'] . "<br>");
            unset($_SESSION['msg']);
        }
        ?></h1>
            <a href='lista.php'>Listar Placas</a>
            <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">

<?php

    //seleciona o campo do horario de entrada do veículo buscando na tabela veiculo onde o id = a variavel
    $result_usuario= "SELECT horario_entrada from veiculo where id=$id";
    $resultado_usuario=mysqli_query($conn,$result_usuario);
    $row_usuario=mysqli_fetch_assoc($resultado_usuario);

    // pega o fuso horário local e armazena separadamente a data e o horário
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $myvalue = date('d-m-Y H:i:s');
    $datetime = new DateTime($myvalue);
    $time2 = $datetime->format('d-m-Y');
    if(isset($_SESSION['data'])){ // checa se a data que está dentro da session
        if($_SESSION['data'] != $time2){ // se ela for diferente da variavél time 2 
            $_SESSION['data']= $time2;// ela atribui a data do time 2 
            $_SESSION["faturamento"] = 0; // zera o faturamento por que é um novo dia 
        }
    }
    else {
        $_SESSION['data']= $time2;
    }
   
    $time = $datetime->format('H:i:s'); // trasforma o formato da data em hora minuto e segundo 
    $dif = abs(strtotime($time) - strtotime($row_usuario['horario_entrada'])); // aqui é a subtração da hora da entrada menos a hora atual
    $tempo = ceil($dif / (60));  //tranformar a hora em minutos para facilitar a lógica , o ceil arredonda o valor para cima
    $horas = $tempo / 60;
    $horas = number_format($horas, 2);
 

    if($tempo <= 15){
        // echo "CORTESIA DO ESTACIONAMENTO. ";
        $valor = 0;
    
        }elseif($tempo <= 60){
            $valor = 27;

        }elseif($tempo <= 120){
            $valor = 32;
        }elseif($tempo > 120){
            $armazena = $tempo - 120;
            $jhgs = ceil($armazena / 60);
        
            $valor= 32;
            for($i=0;$i < $jhgs; $i++){
            $valor+= 9;
            
        }
    }
    // echo "R$".($valor);
    $_SESSION['valor'] = $valor;
    $faturamento =$valor; 
    $_SESSION["faturamento"] += $faturamento; //  valor do faturamento



    $result_usuario ="UPDATE veiculo SET horario_saida=NOW(), estacionado = 0 WHERE id='$id'"; // o veículo ainda vai ficar no banco,porem é le atribuido  no campo estacionado como valor de 0 que significa que ele saiu do estacionamento
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    $result_usuario= "SELECT horario_saida from veiculo where id=$id";
    $resultado_usuario=mysqli_query($conn,$result_usuario);
    $row_usuario=mysqli_fetch_assoc($resultado_usuario);

    if(mysqli_affected_rows($conn)){
        $_SESSION['msg'] ="<p style='color:blue;'>Saída Registrada com Sucesso</p> <p>Valor a Pagar: $valor</p> <p>Horas Usadas: $horas</p> <p> Horário de Saída: " . $row_usuario['horario_saida'] ."";// valor a ser pago
        header("Location: lista.php");
        
    }else{
        $_SESSION['msg'] ="<p style='color:red; '>Saída não Resgistrada. Tente Novamente.</p>"; // caso não seja executado
        header("Location: lista.php");  
    
    }
    // header('Location: pagou.php?id='. $id);

?>