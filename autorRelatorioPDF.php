<?php

include_once("conexao.php");

$html = '<table  ';
$html .= '<thead>';
$html .= '</thead>';
$html .= '<tbody>';

//$result_transacoes = "SELECT DISTINCT autor FROM livro order by autor";
//$result_transacoes = "SELECT autor, COUNT(autor) reg_dup FROM livro GROUP BY autor HAVING reg_dup > 1";
$result_transacoes = "SELECT DISTINCT codigo, CONCAT(autor, '(',count(codigo),')') as autor from livro group by autor";
$resultado_trasacoes = mysqli_query($conn, $result_transacoes);


while ($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)) {
    $html .= '<tr><td> ' . $row_transacoes['autor'] .  " </td></tr>";
    
}
$html .= '</tbody>';
$html .= '</table';
$html .= "------ <p style='color:blue;'>Foram encontrados " . mysqli_num_rows($resultado_trasacoes) . " Autores distintos!</p> <br>";

use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");
$dompdf = new DOMPDF();

$dompdf->load_html('<h1>BookFree - Relatório dos Autores</h1>' . $html . '');

$dompdf->render();

$dompdf->stream("relatorioGeralAutores", array("Attachment" => false //Para realizar o download somente alterar para true
        )
);
?>d