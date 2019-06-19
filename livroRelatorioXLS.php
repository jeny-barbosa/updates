<?php

include_once('conexao.php');

$arquivo = 'Dados Livros.xls';

$tabela = '<table border="1">';
$tabela .= '<tr>';
$tabela .= '<td colspan="2">Relatorio Geral</tr>';
$tabela .= '</tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>Codigo</b></td>';
$tabela .= '<td><b>Nome</b></td>';
$tabela .= '</tr>';

$resultado = mysqli_query($conn, 'SELECT DISTINCT nome, codigo FROM livro');


while ($dados = mysqli_fetch_array($resultado)) {
    $tabela .= '<tr>';
    $tabela .= '<td>' . $dados['codigo'] . '</td>';
    $tabela .= '<td>' . $dados['nome'] . '</td>';
    $tabela .= '</tr>';
}

$tabela .= '</table>';

header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>