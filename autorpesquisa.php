<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Pesquisa Autor</title>
<style> 
    #botoes { 
        position: absolute; 
        left: 58%; 
        top: 105%; 
    } 

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div style="width:700px; margin: 0 auto;">

                <br><br>

                <?php
                require 'usuarioConn.php';
                $filtroautor = $_POST['filtroautor'];


                $sql = "SELECT * FROM livro WHERE autor like '%$filtroautor%'  order by codigo ";
                $consultinha = mysqli_query($conexao, $sql);
                $registro = mysqli_num_rows($consultinha);
                ?>
                
                <section>
                    <?php
                    echo '<br>';
                    echo "<h2> Livros encontrados com o termo <strong> '$filtroautor' </strong> </h2>";
                    echo '<fieldset>';
                    echo '<table class="table table-striped table-bordered">';
                    echo '<tr>';
                    echo '<th width="5%" style="text-align: ; font-size: 14pt;">Código</th>';
                    echo '<th width="30%" style="text-align: center; font-size: 14pt;">Nome do Livro</th>';
                    echo '<th width="30%" style="text-align: center; font-size: 14pt;">Autor</th>';
                    echo '<th width="5%" style="text-align: center; font-size: 14pt;">Edição</th>';

                    echo '</tr>';

                    while ($exibirRegistros = mysqli_fetch_array($consultinha)) {

                        $nome = $exibirRegistros [0];
                        $autor = $exibirRegistros [1];
                        $edicao = $exibirRegistros [2];
                        $codigo = $exibirRegistros [3];

                        echo" <tr>";
                        echo"   <td>$codigo</td>";
                        echo"   <td>$nome</td>";
                        echo"   <td>$autor</td>";
                        echo"  <td>$edicao</td>";
                        echo" </tr>";
                        echo "</fieldset>";
                    }
                    ?>
                </section>
                <?php
                if (isset($_POST['nome'])) {

                    $sql = "SELECT nome FROM livro WHERE livro='nome'";
                    $registro = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo $row["livro"] . "<br/>";

                            print "Resultados da pesquisa com a palavra: <strong> $filtro </strong>";
                            print "<br> <br>";

                            print "Total de Registros encontrados: <strong>$registro </strong>";
                            print "<br> <br>";

                            while ($exibirRegistros = mysqli_fetch_array($consultinha)) {


                                $nome = $exibirRegistros [0];
                                $autor = $exibirRegistros [1];
                                $edicao = $exibirRegistros [2];
                                $codigo = $exibirRegistros [3];

                                print '<article>';
                                print '<strong>Nome do Livro: </strong>    $nome<br>';
                                print '<strong>Autor:</strong>            $autor<br>';
                                print '<strong>Edicao:</strong>           $edicao<br>';
                                print '<strong>Codigo:</strong>           $codigo<br>';
                                echo '<br>';
                                print '</article>';
                            }
                        }
                    } else {
                        echo "Nada foi encontrado.";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="botoes">
      
             <a href="telaLivro.php" class="btn btn-primary btn-primary"><i  style="font-size:48px;color:white" class="	fa fa-step-backward"></i></a>
            <!-- <a href="autorRelatorio.php" class="btn btn-primary btn-danger"  target="_blank"><i  style="font-size:48px;color:white" class="fa fa-file-pdf-o"></i></a>
            
             <a href="telaLivro.php" class="btn btn-primary btn-success"><i  style="font-size:48px;color:white" class="fa fa-file-excel-o"></i></a>-->
        </div>
    </div> 
</div>

