<?php

require 'conexao.php';

$valida = true;

if ($_POST['nome-add'] == '') {
    $retorno .= "Preencha o campo Nome <br />";
    $valida = false;
}

if ($_POST['autor-add'] == '') {
    $retorno .= "Preencha o campo Autor<br />";
    $valida = false;
}

if ($_POST['edicao-add'] == '') {
    $retorno .= "Preencha o campo Edição <br />";
    $valida = false;
}


if ($valida) {
    //   $codigo = $_POST['codigo'];
    $nome = $_POST['nome-add'];
    $autor = $_POST['autor-add'];
    $edicao = $_POST['edicao-add'];

    mysqli_query($conn, "INSERT INTO livro(nome, autor, edicao) VALUES ('$nome', '$autor', '$edicao')");

    if (mysqli_affected_rows($conn) != -1) {
        $retorno = 'Dados inseridos com sucesso!';
    } else {
        $retorno = 'Erro ao inserir os dados';
    }
}

echo $retorno;



