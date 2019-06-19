<?php
session_start();
require 'conexao.php';
$iOffset = empty($_GET['pagina']) ? 0 : ($_GET['pagina'] * 15) - 15;
$query = "SELECT * FROM livro LIMIT 15 OFFSET ".$iOffset;
$result = mysqli_query($conn, $query);

$aKeys = array_keys($_GET);
if(in_array('pagina', $aKeys)) {
    $iPagina = $_GET['pagina'];
} else {
    $iPagina = 1;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Book Free</title>
        <meta charset = "utf-8">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
        <meta name="google-signin-client_id" content="444094126116-nkdc6oda1qb2ro0uq1mi5rg8dp8t23vd.apps.googleusercontent.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .numero{
                text-decoration: none;
                background: #2A85B6;
                text-align: center;
                padding: 3px 0;
                display: block;
                margin: 0 2px;
                float: left;
                width: 20px;
                color: #fff;
            }
            .numero:hover, .numativo, .controle:hover{
                background: #1B3B54;
            }
            .controle{
                text-decoration: none;
                background: #2A85B6;
                text-align: center;
                padding: 3px 8px;
                display: block;
                margin: 0 3px;
                float: left;
                color: #fff;
            }
        </style>

    </head>
    <body>

        <div class="container" style="width:700px;">
            <br>

            <div class="table-responsive">

                <div align="right">
                    <a href="#" onclick="signOut();" class="btn btn-danger">Sair <span class="glyphicon glyphicon-log-out"></span></a> 

                    <div align="left"><br>
                        <div align="left">

                            <button type="button" name="filtronome" id="filtronome" data-toggle="modal" data-target="#livro_Modal" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span> Busca Livro</button> &nbsp;
                            <button type="button" name="filtroautor" id="filtroautor" data-toggle="modal" data-target="#autor_Modal" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-user"></span> Busca Autor </button> &nbsp;
                            <button type="button" name="filtroedicao" id="filtroedicao" data-toggle="modal" data-target="#edicao_Modal" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-calendar"></span> Busca Edição</button> &nbsp;
                            <button type="button" name="relatorios" id="relatorios" data-toggle="modal" data-target="#relatorio_Modal" class="btn btn-success"> <span class="glyphicon glyphicon-folder-open"></span> Relatórios Gerais</button> &nbsp;
                            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Adicionar <span class="glyphicon glyphicon-plus"></span> </button> 

                        </div>
                    </div>
                    <script>
                        function signOut() {
                            var auth2 = gapi.auth2.getAuthInstance();
                            console.log(auth2);
                            auth2.signOut().then(function () {
                                deleteAllCookies();
                            });
                            auth2.disconnect();
                            setTimeout(function () {
                                location.href = "index.php";
                            }, 2000);
                        }

                        function deleteAllCookies() {
                            var cookies = document.cookie.split(";");

                            for (var i = 0; i < cookies.length; i++) {
                                var cookie = cookies[i];
                                var eqPos = cookie.indexOf("=");
                                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                            }
                        }

                        function onLoad() {
                            gapi.load('auth2', function () {
                                gapi.auth2.init();
                            });
                        }
                    </script>

                    <br/><br/>

                    <div id="employee_table">
                        <table class="table table-striped table-bordered">

                            <tr align="center">
                                <th width="5%" style="text-align: center; font-size: 14pt;">Código</th>
                                <th width="50%" style="text-align: center; font-size: 14pt;">Nome do Livro</th>
                                <th width="20%" style="text-align: center; font-size: 14pt;">Ação</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr >
                                    <td style="text-align: center; font-style: oblique;"><?php echo $row['codigo']; ?></td>
                                    <td style="font-size: 14pt; font-style: oblique;"><?php echo $row['nome']; ?></td>
                                    <td align="center">
                                        <button type="button" name="view" value="view" codigo="<?php echo $row['codigo']; ?>" class="btn btn-success  view_data"><span class="glyphicon glyphicon-eye-open"></span></button>
                                        <button type="button" name="edit" value="Edit" codigo="<?php echo $row['codigo']; ?>" class="btn btn-info edit_data"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button type="button" name="delete" value="delete" codigo="<?php echo $row['codigo']; ?>" class="excluirReg btn btn-dark "><span class="glyphicon glyphicon-trash"></span></button>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div align="center">
                <a href="telaLivro.php" class="btn btn-default <?=($iPagina == 1) ? 'btn-lg btn-primary' : '' ?>"> 1</a>
                <a href="telaLivro.php?pagina=2" class="btn btn-default <?=($iPagina == 2) ? 'btn-lg btn-primary' : '' ?>"> 2 </a>
                <a href="telaLivro.php?pagina=3" class="btn btn-default <?=($iPagina == 3) ? 'btn-lg btn-primary' : '' ?>"> 3 </a>
                <a href="telaLivro.php?pagina=4" class="btn btn-default <?=($iPagina == 4) ? 'btn-lg btn-primary' : '' ?>"> 4 </a>
                <a href="telaLivro.php?pagina=5" class="btn btn-default <?=($iPagina == 5) ? 'btn-lg btn-primary' : '' ?>"> 5 </a>
                <!-- <a href="telaLivro6.php" class="btn btn-default disabled"> 6 </a>
                <a href="telaLivro7.php" class="btn btn-default disabled"> 7 </a>-->
            </div>
            <!--Modal Adicionar -->
            <div id="add_data_Modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Adicionar novo livro</h4>
                        </div>
                        <div class="modal-body">
                            <form name="form1" id="form1" class="form-horizontal">
                                <div class="form-group">
                                    <label for="nome-add" class="col-sm-2 control-label"> Nome do Livro: *</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nome-add" id="nome-add" class="form-control" placeholder="Fulano de Tal" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="autor-add" class="col-sm-2 control-label"> Autor: *</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="autor-add" id="autor-add" class="form-control" placeholder="Ciclano de Tal" required x-moz-errormessage="Ops. Não esqueça de preencher este campo."/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edicao-add" class="col-sm-2 control-label"> Edição: *</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="edicao-add" id="edicao-add" class="form-control" placeholder="1500" required>
                                    </div>
                                    <div align="right" style="margin-right: 15px">
                                        <input type="button" id="enviar" value="Adicionar" class="btn btn-primary" />
                                    </div>
                                    <div id="resultado"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal Relatórios -->
            <div id="relatorio_Modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title" style="font-size:30px;">Relatórios Gerais</h>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <tr align="center">
                                    <th style="font-size:40px; text-align: center;" >PDF <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></th>
                                    <th style="font-size:40px; text-align: center;">XLS <i class="fa fa-file-excel-o" style="font-size:48px;color:green"></i></th>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="livroRelatorioPDF.php" target="_blank" class="btn btn-primary">Todos os Livros <span class="glyphicon glyphicon-book"></span></a><br><br>
                                        <a href="autorRelatorioPDF.php" target="_blank" class="btn btn-success">Todos os Autores <span class="glyphicon glyphicon-user"></span></a><br><br>
                                        <a href="edicaoRelatorioPDF.php" target="_blank" class="btn btn-warning">Todas as Edições <span class="glyphicon glyphicon-calendar"></span></a><br><br>
                                        <a href="geralRelatorioPDF.php"  target="_blank" class="btn btn-danger">Geral <span class="glyphicon glyphicon-credit-card"></span></a><br><br>
                                    </td>
                                    <td align="center">
                                        <a href="livroRelatorioXLS.php" target="_blank" class="btn btn-primary">Todos os Livros <span class="glyphicon glyphicon-book"></span></a><br><br>
                                        <a href="autorRelatorioXLS.php" target="_blank" class="btn btn-success">Todos os Autores <span class="glyphicon glyphicon-user"></span></a><br><br>
                                        <a href="edicaoRelatorioXLS.php" target="_blank" class="btn btn-warning">Todas as Edições <span class="glyphicon glyphicon-calendar"></span></a><br><br>
                                        <a href="geralRelatorioXLS.php" target="_blank" class="btn btn-danger">Geral <span class="glyphicon glyphicon-credit-card"></span></a><br><br>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal Pesquisar Livro -->
            <div id="livro_Modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Pesquisar Livro</h4>
                        </div>
                        <div class="modal-body">
                            <form name="form1" id="form1" class="form-horizontal" action="livropesquisa.php" method="post">
                                <div class="form-group">
                                    <label for="nome-add" class="col-sm-2 control-label"> Nome do Livro: </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="filtronome" id="filtronome" class="form-control" placeholder="Fulano de Tal" />
                                    </div>
                                </div>
                                <div align="right" style="margin-right: 15px">
                                    <input type="submit" id="enviar" value="Pesquisar" class="btn btn-primary"/>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Pesquisar Autor -->
        <div id="autor_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pesquisar Livro</h4>
                    </div>
                    <div class="modal-body">
                        <form name="form1" id="form1" class="form-horizontal" action="autorpesquisa.php" method="post">
                            <div class="form-group">
                                <label for="nome-add" class="col-sm-2 control-label"> Nome do Livro: </label>
                                <div class="col-sm-10">
                                    <input type="text" name="filtroautor" id="filtroautor" class="form-control" placeholder="Fulano de Tal" />
                                </div>
                            </div>
                            <div align="right" style="margin-right: 15px">
                                <input type="submit" id="enviar" value="Pesquisar" class="btn btn-primary"/>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Pesquisar Edição -->
    <div id="edicao_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pesquisar Livro</h4>
                </div>
                <div class="modal-body">
                    <form name="form1" id="form1" class="form-horizontal" action="edicaopesquisa.php" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Edição: </label>
                            <div class="row">
                                <label>  De  <input type="text" name="campo1" id="campo1" class="form-control" placeholder="1900"/> </label>
                                <label> até  <input type="text" name="campo2" id="campo2" class="form-control" placeholder="1920"/></label>

                            </div>
                        </div>
                        <div align="right" style="margin-right: 15px">
                            <input type="submit" id="enviar" value="Pesquisar" class="btn btn-primary"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Visualizar -->
    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalhe do Livro <?php echo $row['codigo']; ?> </h4>
                </div>
                <div class="modal-body" id="employee_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Excluir -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Excluir Livro</h4>
                </div>
                <div class="modal-body">
                    <p class="sucess-message">Tem certeza de que quer excluir o registro?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success delete-confirm" type="button">Sim</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Não</button>
                </div>
                <div id="result"></div>
            </div>
        </div>
    </div>

    <!--Modal Atualizar -->
    <div id="ed_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Atualizar Livro</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="edit_form">
                        <label>Livro</label>
                        <input type="text" name="nome" id="nome-insert" class="form-control" value="<?php echo $row['nome']; ?>"/>
                        <br />
                        <label>Autor</label>
                        <input type="text" name="autor" id="autor-insert" class="form-control" />
                        <br />
                        <label>Edição</label>
                        <input type="text" name="edicao" id="edicao-insert" class="form-control" />
                        <br />
                        <input type="hidden" name="codigo" id="codigo-insert" />
                        <input type="submit" name="edit" id="edit" value="Editar" class="btn btn-success" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        /* Script Adicionar */
        $(document).ready(function () {
            $('#enviar').click(function () {

                if ($('#nome-add').val() === "") {
                    alert("Digite o nome do Livro");
                }
                else if ($('#autor-add').val() === '') {
                    alert("Digite o nome do Autor");
                }
                else if ($('#edicao-add').val() === '') {
                    alert("Digite a Edição");
                }
                else
                {
                    $.ajax({
                        url: 'inserir.php',
                        type: 'POST',
                        data: 'nome-add=' + $('#nome-add').val() + '&autor-add=' + $('#autor-add').val() + '&edicao-add=' + $('#edicao-add').val(),
                        success: function (data) {
                            $('#resultado').html(data);
                            alert("Dados inseridos");
                            location.href = "telaLivro.php";
                            window.close();
                        }
                    });
                }
            });
        });

        /* Script Detalhes */
        $(document).on('click', '.view_data', function () {
            var codigo = $(this).attr("codigo");
            if (codigo !== '')
            {
                $.ajax({
                    url: "detalhes.php",
                    method: "POST",
                    data: {codigo: codigo},
                    dataType: "html",
                    success: function (data) {
                        $('#employee_detail').html(data);
                        $('#dataModal').modal('show');
                    }
                });
            }
        });

        /* Script Excluir */

        var codigo;
        $('.excluirReg').click(function () {
            codigo = $(this).attr('codigo');
            $('.deleteID').val(codigo)
            $("#myModal").modal('show');
        });

        $('.delete-confirm').click(function () {
            if (codigo != '') {
                $.ajax({
                    url: 'excluir.php',
                    data: {'codigo': codigo},
                    method: "post",
                    success: function (data) {
                        $('#result').html(data);
                        alert("Dados Excluidos");
                        location.href = "telaLivro.php";
                        window.close();
                    }
                });
            }
        });
        /* Script Atualizar */
        $('#edit_form').on("submit", function (event) {
            //cancelando submit do form
            event.preventDefault();
            if ($('#nome-insert').val() === "") {
                alert("Digite o nome do Livro");
            }
            else if ($('#autor-insert').val() === '') {
                alert("Digite o nome do Autor");
            }
            else if ($('#edicao-insert').val() === '') {
                alert("Digite a Edição");
            }
            else
            {
                $.ajax({
                    url: "atualizar.php",
                    method: "POST",
                    dataType: "json",
                    data: $('#edit_form').serialize(),
                    beforeSend: function () {
                        $('#edit').val("Atualizado");
                        alert("Dados Atualizados");
                        location.href = "telaLivro.php";
                        window.close();
                    },
                    success: function (data) {
                        $('#edit_form')[0].reset();
                        $('#ed_data_Modal').modal('hide');
                        $('#employee_table').html(data);
                    }
                });
            }
        });
        $(document).ready(function () {
            $('#add').click(function () {
                $('#insert').val("Insert");
            });
            $(document).on('click', '.edit_data', function () {
                var codigo = $(this).attr("codigo");
                $.ajax({
                    url: "buscar.php",
                    method: "POST",
                    data: {'codigo': codigo},
                    dataType: "json",
                    success: function (data) {
                        $('#nome-insert').val(data.nome);
                        $('#autor-insert').val(data.autor);
                        $('#edicao-insert').val(data.edicao);
                        $('#codigo-insert').val(data.codigo);
                        $('#edit_data').val("Editar");
                        $('#ed_data_Modal').modal('show');
                    }
                });
            });
        });


        /* Script Buscar */
    </script>
</body>
</html>