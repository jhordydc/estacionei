<?php
    // function cadastra(){
        session_start();
        include_once('conexao.php');
        include_once('validar.php');
        
        // pega o fuso horário local e armazena separadamente a data e o horário
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $myvalue = date('Y-m-d H:i:s');
        $datetime = new DateTime($myvalue);
        $date = $datetime->format('Y-m-d');
        $time = $datetime->format('H:i:s'); 

        
        // checa se a sessão dataHoje existe, e se existe checha se é igual à data de hoje
        // se não for ou não existir, atribui a data de hoje à sessão e reseta o contador de carros       
        if (isset($_SESSION['dataHoje'])) {
            if ($_SESSION['dataHoje'] != $date) {
                $_SESSION['carrosDia'] = 0;
                $_SESSION['dataHoje'] = $date;
            }
        }
        else {
            $_SESSION['dataHoje'] = $date;
            $_SESSION['carrosDia'] = 0;
        }
        

        // pega os dados do input e valida a placa após remover caracteres especiais
        $placa_cad = filter_input(INPUT_POST, 'placa', FILTER_SANITIZE_STRING);
        $placa_cad = str_replace('-', '', $placa_cad);
        $placa_cad = strtoupper($placa_cad);
        valida_placa($placa_cad);

        // pega a hora e data de hoje
        $hora_entrada = $time;
        $data_registro = $date;
        
        // conta a quantidade de carros no banco de dados, para conferir se o valor é menor a 200
        $result_carros = "SELECT COUNT(id) AS qt_ativos FROM veiculo WHERE estacionado = 1";
        $resultado_carros = mysqli_query($conn, $result_carros);
        $ativos = mysqli_fetch_assoc($resultado_carros);

        $existe = mysqli_query($conn, "SELECT COUNT(id) AS existe FROM veiculo WHERE placa = '$placa_cad'");
        $checagem = mysqli_fetch_assoc($existe);

        $estacionado = mysqli_query($conn, "SELECT * FROM veiculo WHERE placa = '$placa_cad'");
        $estaEstacionado = mysqli_fetch_assoc($estacionado);

        // caso a placa seja válida e o número de carros estacionados for menor que 200, cadastra no banco
        if ($valido && $ativos['qt_ativos'] < 200){
            if ($checagem['existe'] == 0) {
                $result_cadastro = "INSERT INTO veiculo (placa, data_cadastro, horario_entrada, estacionado) VALUES ('$placa_cad', '". $data_registro ."', '". $hora_entrada ."', 1)";
                $resultado_cadastro = mysqli_query($conn, $result_cadastro);  
                $_SESSION['msg'] = "Cadastro feito com sucesso.";
                $carrosDia = 1;
                $_SESSION['carrosDia'] += $carrosDia;
                header('Location: index_placa.php');  
            }
            else {
                if ($estaEstacionado['estacionado'] == 0) {
                    $result_cadastro = "UPDATE veiculo SET data_cadastro = '". $data_registro ."', horario_entrada = '". $hora_entrada ."', estacionado = 1  WHERE placa = '$placa_cad'";
                    $resultado_cadastro = mysqli_query($conn, $result_cadastro);
                    $_SESSION['msg'] = "Cadastro feito com sucesso.";
                    $carrosDia = 1;
                    $_SESSION['carrosDia'] += $carrosDia;
                    header('Location: index_placa.php');
                    
                }
                else {
                    $_SESSION['msg'] = "Erro: Carro já Estacionado.";
                    header('Location: index_placa.php');
                }
            }
        }
        // caso haja registro, envia uma mensagem de sucesso e adiciona um ao contador
        else{
            if($valido == false){
                $_SESSION['msg'] = "Erro: Placa Inválida.";
            }
            else{
                $_SESSION['msg'] = "Erro: Erro no Banco.";
            }
            header('Location: index_placa.php');
        }
        
    // };
?>