<?php
	//inclui as bibliotecas
	require_once('Conexao.class.php');
	//faz a conexÃ£o com o BD
	$pdo = new Conexao(); 
	//determina o numero de registros que serÃ£o mostrados na tela
	$maximo = 20;
	//pega o valor da pagina atual
	$pagina = isset($_GET['pagina']) ? ($_GET['pagina']) : '1'; 
	
	//subtraimos 1, porque os registros sempre comeÃ§am do 0 (zero), como num array
	$inicio = $pagina - 1;
	//multiplicamos a quantidade de registros da pagina pelo valor da pagina atual 
	$inicio = $maximo * $inicio; 
	//fazemos um select na tabela que iremos utilizar para saber quantos registros ela possui
	$strCount = $pdo->select("SELECT COUNT(*) AS 'total_livro' FROM livro");
	//iniciamos uma var que serÃ¡ usada para armazenar a qtde de registros da tabela  
	$total = 0;
	if(count($strCount)){
		foreach ($strCount as $row) {
			//armazeno o total de registros da tabela para fazer a paginaÃ§Ã£o
			$total = $row["total_livro"]; 
		}
	}
	//guardo o resultado na variavel pra exibir os dados na pagina		
	$resultado = $pdo->select("SELECT * FROM livro ORDER BY codigo LIMIT $inicio,$maximo");
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Book Free</title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
            <h3 align="center">Livros</h3>
            <br /> 
      
            <div class="table-responsive">
            
                <div align="right">




                    <a href="#" onclick="signOut();" class="btn btn-danger">Sair <span class="glyphicon glyphicon-log-out"></span></a>
                    <div align="left">  
                        <div align="left">
                            <button type="button" name="filtronome" id="filtronome" data-toggle="modal" data-target="#livro_Modal" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span> Busca Livro</button> &nbsp;
                            <button type="button" name="filtroautor" id="filtroautor" data-toggle="modal" data-target="#autor_Modal" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-user"></span> Busca Autor </button> &nbsp;
                            <button type="button" name="filtroedicao" id="filtroedicao" data-toggle="modal" data-target="#edicao_Modal" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-calendar"></span> Busca Edição</button> &nbsp;
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