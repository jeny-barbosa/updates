<?php

require 'usuarioConn.php';
header("Content-Type: text/html; charset=ISO-8859-1");

$nome = $_POST['nome'];
$senha = $_POST['senha'];
$confirma = $_POST['confirmaSenha'];


$valida = true;

if ($valida) {
    $nome = $_POST['nome'];
    $senha = md5 ($_POST['senha']);
    $token = $_POST['token'];
    $query = mysqli_query($conexao, "SELECT email from tokenusuarios where token='$token'");
    $result = mysqli_fetch_array($query);
    $email = $result[0];

    $mysqli_query= mysqli_query($conexao, "INSERT INTO usuarios(nome, senha,email) VALUES ('$nome', '$senha','$email')");

    if (mysqli_affected_rows($conexao) != -1) {
        $retorno = 'Dados inseridos com sucesso!';
       header('location:telaLivro.php');
    } else {
        $retorno = 'Erro ao inserir os dados';
    }
}

echo $retorno;
?>