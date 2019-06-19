<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Login - BookFree </title>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="444094126116-nkdc6oda1qb2ro0uq1mi5rg8dp8t23vd.apps.googleusercontent.com">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
             

    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="verificaLogin.php" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">E-mail:</label><br>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="text-info">Senha:</label><br>
                                    <input type="password" name="senha" id="senha" class="form-control">
                                </div>
                                <div class="form-group" align="center">
                                    <input type="submit" name="entrar" class="btn btn-block btn-lg btn-primary" value="Entrar"> <br>

                                    <a href="#" data-toggle="modal" data-target="#ModalLongoExemplo"> Não possui login? Cadastre-se aqui!</a>
                                </div>
                                <div class="g-signin2" data-onsuccess="onSignIn" align="center"></div>
        
        <p id='msg'></p>
        <script>
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            var userID = profile.getId(); 
            var userName = profile.getName(); 
            var userPicture = profile.getImageUrl(); 
            var userEmail = profile.getEmail();              
            var userToken = googleUser.getAuthResponse().id_token; 
            console.log(googleUser);
            console.trace();
            //document.getElementById('msg').innerHTML = userEmail;
            if(userEmail !== ''){
                var dados = {
                    userID:userID,
                    userName:userName,
                    userPicture:userPicture,
                    userEmail:userEmail
                };
                console.log(dados);
                $.post('valida.php', dados, function(retorna){
                    if(retorna === '"erro"'){
                        var msg = "Usuário não encontrado com esse e-mail";
                        document.getElementById('msg').innerHTML = msg;
                    }else{
                        window.location.href = retorna;
                    }
                    
                });
            }else{
                var msg = "Usuário não encontrado!";
                document.getElementById('msg').innerHTML = msg;
            }
        }
        </script>       
                                <p></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container body-content">
            <!-- Modal -->
            <div class="modal fade" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="TituloModalLongoExemplo" >Cadastro de Usuário</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="email.php" method="post" class="form-horizontal" id="FormSenha">
                                <label for="Email" class="modal-title">E-mail:</label>
                                <input type="text" name="Email" id="Email" class="form-control" id="email-user" required="true"/>
                                <br> 
                                <input type="submit" name="Enviar" value="Enviar" class="btn btn-block btn-lg btn-primary" id="enviar"/>
                            </form>
                        </div>
                    </div>

                    
       
                    <footer>
                        <p>&copy; BookFree</p>
                    </footer>
</body>
</html>

