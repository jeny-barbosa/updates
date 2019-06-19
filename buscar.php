<?php

//fetch.php  

$connect = mysqli_connect("localhost", "root", "", "projetobd");
if (isset($_POST["codigo"])) {
    $query = "SELECT * FROM livro WHERE codigo = '" . $_POST["codigo"] . "'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>