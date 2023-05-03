
<?php
    // function cadastra_funcionario(){
        session_start();
        include_once('conexao.php');

        // pega os dados do input
        $nome = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $senha_crip = md5($senha);
    
        // checa se já existe um usuário com nome idêntico
        $quant_nome = mysqli_query($conn, "SELECT COUNT(id) AS cadastrado FROM funcionario WHERE usuario = '$nome';");
        $cadastrado = mysqli_fetch_assoc($quant_nome);
    
        // caso não haja, cadastra o
        if ($cadastrado['cadastrado'] == 0) {
            $result_funcionario = "INSERT INTO funcionario (usuario, senha) VALUES ('$nome', '$senha_crip')";
            $resultado_funcionario = mysqli_query($conn, $result_funcionario);
        }
        
        if (mysqli_insert_id($conn)) {
            $_SESSION['msg'] = "Funcionário Cadastrado com Sucesso.";
            header('Location: index_func.php');
        }
        else{
            $_SESSION['msg'] = "Funcionário não Cadastrado.";
            header('Location: index_func.php');
        }
    // }
    
?>