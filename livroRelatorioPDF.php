<?php

include_once("conexao.php");
$html = '<table border=1 align="center"';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Codigo</th>';
$html .= '<th>Nome do Livro</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes = "SELECT DISTINCT nome, codigo FROM livro ";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
    $html .= '<tr><td>' . $row_transacoes['codigo'] . "</td>";
    $html .= '<td>' . $row_transacoes['nome'] . "</td></tr>";
}

$html .= '</tbody>';
$html .= '</table';
$html .= "------ <p style='color:blue;'>Foram encontrados " . mysqli_num_rows($resultado_trasacoes) . " Autores distintos!</p> <br>";

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html('
			<h1 style="text-align: center;">BookFree - Relatório dos Livros</h1>
			' . $html . '
		');
$dompdf->render();

$dompdf->stream(
        "relatorioLivro", array(
    "Attachment" => false //Para realizar o download somente alterar para true
        )
);
?>