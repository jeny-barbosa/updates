<?php

session_start();
require 'conexao.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$query = "SELECT email, senha FROM `usuarios` WHERE `email` = '$email' AND `senha`= '$senha'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    header('location: telaLivro.php');
} else {
    session_destroy();
    header('location:index.php');
}
?>