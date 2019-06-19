<?php

include_once('conexao.php');

$arquivo = 'Dados Gerais Autores.xls';

$tabela = '<table border="1">';
$tabela .= '<tr>';
$tabela .= '<td colspan="2">Relatorio Geral</tr>';
$tabela .= '</tr>';
$tabela .= '<tr>';
$tabela .= '<td><b>Autor</b></td>';
$tabela .= '</tr>';

$resultado = mysqli_query($conn, 'SELECT DISTINCT autor FROM livro order by autor');

while ($dados = mysqli_fetch_array($resultado)) {
    $tabela .= '<tr>';
    $tabela .= '<td>' . $dados['autor'] . '</td>';
    $tabela .= '</tr>';
}

$tabela .= '</table>';

header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;
?>