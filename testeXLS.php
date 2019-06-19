<?php
include 'conexao.php';
 
$query = "SELECT * FROM livro";

$executar_query = mysqli_query($conn, $query);

$contar = mysqli_num_rows($executar_query);
 
for($i=0;$i<1;$i++){   
$html[$i] = "";
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td><b>Nome</b></td>";
    $html[$i] .= "<td><b>Twitter</b></td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
}
 
$i = 1;


while($ret = mysqli_fetch_array($executar_query)){
 $retorno_nome = $ret['nome'];
 $retorno_twitter = $ret['autor'];
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td>$retorno_nome</td>";
    $html[$i] .= "<td>$retorno_twitter</td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
    $i++;
}
 
$arquivo = 'soudev.xls';
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename={$arquivo}" );
header ("Content-Description: PHP Generated Data" );
 
for($i=0;$i<=$contar;$i++){  
    echo $html[$i];
}
?>