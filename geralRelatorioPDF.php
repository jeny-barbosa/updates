<?php

include_once("conexao.php");
$html = '<table border=1 align="center"';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Codigo</th>';
$html .= '<th>Nome do Livro</th>';
$html .= '<th>Autores</th>';
$html .= '<th>Edição</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$result_transacoes = "SELECT DISTINCT * FROM livro ";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
    $html .= '<tr><td>' . $row_transacoes['codigo'] . "</td>";
    $html .= '<td>' . $row_transacoes['nome'] . "</td>";
    $html .= '<td>' . $row_transacoes['autor'] . "</td>";
    $html .= '<td>' . $row_transacoes['edicao'] . "</td></tr>";
}
$html .= '</tbody>';
$html .= '</table';
$html .= "------ <p style='color:blue;'>Foram encontrados " . mysqli_num_rows($resultado_trasacoes) . " Livros distintos!</p> <br>";

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");

$dompdf = new DOMPDF();

$dompdf->load_html('
			<h1 style="text-align: center;">BookFree - Relatório Geral</h1>
			' . $html . '
		');

$dompdf->render();

$dompdf->stream(
        "relatorio_celke.pdf", array(
    "Attachment" => false //Para realizar o download somente alterar para true
        )
);
?>