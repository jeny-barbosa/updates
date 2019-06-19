<?php
    $host = "localhost";
    $banco = "projetobd";
    $usuario = "root";
    $senha = "";
    $conn = mysqli_connect($host, $usuario, $senha, $banco);
/*if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
} 
else
{
   // $query = "SELECT * FROM livro ORDER BY codigo DESC";
    $query = "SELECT * FROM livro LIMIT 15";
    $result = mysqli_query($conn, $query);
}*/
    
    ?>

