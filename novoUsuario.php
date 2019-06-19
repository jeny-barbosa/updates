<!DOCTYPE html>
<html lang="pt-br">

    <head>    
        <title>Novo Usuário</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="form" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <h3 class="text-center text-info">Cadastro do Novo Usuário</h3>
                            <form action="registraUsuario.php" method="post" id="formUsuario">

                                <div class="form-group">                                    
                                    <input type="hidden" name="token" id="token" class="form-control" value="<?= $_GET['token'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nome" class="text-info">Nome:</label><br>
                                    <input type="text" name="nome" id="nome" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Senha:</label><br>
                                    <input type="password" name="senha" id="senha" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="senha2" class="text-info">Confirma Senha:</label><br>
                                    <input type="password" name="senha2" id="senha2" class="form-control" required="required">
                                </div>
                                <div class="form-group" align="center">
                                    <input type="submit" id="enviar" class="btn btn-block btn-lg btn-primary" value="Entrar" >
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function validarSenha(form) {
                senha = document.formulario.senha.value;
                senha2 = document.formulario.repetir_senha.value;
                if (senha !== senha2) {
                    alert("Repita a senha corretamente");
                    document.formulario.repetir_senha.focus();
                    return false;
                }
            }

            /* $(document).ready(function () {
             $('#enviar').click(function () {
             
             if ($('#nome').val() === "") {
             alert("Digite o NOME");
             }
             else if ($('#senha').val() === '') {
             alert("Digite a SENHA");
             }
             else if ($('#senha').val() !== $('#confirmaSenha').val()) {
             alert("AS SENHAS S�O DIFERENTES");
             }
             else
             {
             $.ajax({
             url: 'registraUsuario.php',
             type: 'POST',
             data: 'nome=' + $('#nome').val() + '&senha=' + $('#senha').val() + '&token=' + $('#token').val() ,
             success: function (data) {
             $('#resultado').html(data);
             alert("Dados inseridos");
             location.href = "telaLivro.php";
             
             }
             });
             }
             });
             });
             
             
             
             function validarSenha() {
             senha = document.formSenha.senha.value;
             confirmaSenha = document.formSenha.confirmaSenha.value;
             if (senha === confirmaSenha) {
             
             location.href = "registraUsuario.php";
             
             } else {
             alert("SENHAS DIFERENTES \nFAVOR DIGITAR SENHAS IGUAIS");
             
             }
             }*/
        </script>
    </body>
</html>