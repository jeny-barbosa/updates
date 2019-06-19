<?php

require 'conexao.php';


$codigo = $_POST["codigo"];


$sql = "DELETE FROM livro WHERE codigo = '" . $codigo . "'";


$result = $conn->query($sql);


echo json_encode([$codigo]);
?>