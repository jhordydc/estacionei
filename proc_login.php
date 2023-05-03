
<?php

    session_start();
    include_once('conexao.php');
    $nome = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $senhaCrip = md5($senha);

    // checa se tem administrador cadastrado no banco no banco
    $aoMenosUm = mysqli_query($conn, "SELECT COUNT(id) AS temUm FROM funcionario WHERE usuario = 'admin'");
    $temUm = mysqli_fetch_assoc($aoMenosUm);

    // pega as informações da linha onde nome seja igual ao informado e a senha seja igual a informada criptografada
    $existe = mysqli_query($conn, "SELECT * FROM funcionario WHERE usuario = '$nome' AND senha = '$senhaCrip'");
    $checagem = mysqli_fetch_assoc($existe);    

    // se os inputs forem igual ao que está registrado no campo, loga como admin ou funcionário
    if ($temUm['temUm'] != 0) {
        if ($checagem['usuario'] == $nome && $checagem['senha'] == $senhaCrip) {
            $_SESSION['msg'] = 'Login feito com sucesso';
            $entrou = mysqli_query($conn, "UPDATE funcionario SET funcionario_entrada = NOW() WHERE usuario = '$nome' AND senha = '$senhaCrip'");
            if ($checagem['usuario'] == "admin") {
                header('Location: index_func.php');
            }
            else {
                header('Location: lista.php');
            }
        }
        else {
            $_SESSION['msg'] = "Erro: Usuário ou Senha Incorretos.";
            header('Location: login.html');
        }
    }
    else if ($nome == "admin" && $senha == "admin"){
        $_SESSION['msg'] = 'Entrou com Usuário Temporário. Cadastre um administrador com o nome "admin".';
        header('Location: index_func.php');
    }
    else {
        $_SESSION['msg'] = "Erro: Usuário ou Senha Incorretos.";
        header('Location: entrar.php');
    }

    // caso não, envia uma mensagem de erro
    

?>