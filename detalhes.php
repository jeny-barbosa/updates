<?php

if (isset($_POST["codigo"])) {
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "projetobd");
    $query = "SELECT * FROM livro WHERE codigo = '" . $_POST['codigo'] . "'";
    $result = mysqli_query($connect, $query);
    $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= ' 
                 <tr>  
                     <td width="10%"><label>Código</label></td>  
                     <td width="30%">' . $row['codigo'] . '</td>  
                </tr>  
                <tr>  
                     <td width="10%"><label>Nome do Livro</label></td>  
                     <td width="30%">' . $row['nome'] . '</td>  
                </tr>  
                <tr>  
                     <td width="10%"><label>Autor</label></td>  
                     <td width="30%">' . $row['autor'] . '</td>  
                </tr>  
                <tr>  
                     <td width="10%"><label>Edição</label></td>  
                     <td width="30%">' . $row['edicao'] . '</td>  
                </tr> 
                <tr>  
                     <td width="10%"><label>Livro em PDF</label></td>  
                     <td width="30%"><a href="obras/' . $row['codigo']. '.pdf" target="_blank" name="livro" >Clique aqui para abrir o PDF</a></td>  
                </tr>
                
           ';
    }
    $output .= '  
           </table>  
      </div>  
      ';
    echo $output;
}
?>
 