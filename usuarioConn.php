<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$banco = "projetobd";
$conexao = mysqli_connect($host, $user, $pass) or die(mysqli_error());
mysqli_select_db($conexao, $banco) or die(mysqli_error($conexao));
