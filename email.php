<?php

require 'usuarioConn.php';

$Email = $_POST["Email"]; // Pega o valor do campo Email
$token = md5(date('Y-m-d H:i:s') . $Email);
//$validade = 
$inserir = mysqli_query($conexao, "INSERT INTO tokenusuarios(email, token) VALUES ('$Email', '$token')");

echo 'Gravado com sucesso';

$url = "http://localhost/bookFree/novoUsuario.php?token=" . $token;
$Vai = 'Por favor, acesse o link ' . $url . ' para continuar o seu cadastro';
require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'jennefer.barbosah@gmail.com'); // <-- Insira aqui o seu GMail
define('GPWD', 'jalb170897');  // <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
    global $error;
    $mail = new PHPMailer();
    $mail->IsSMTP();  // Ativar SMTP
    $mail->SMTPDebug = 1;  // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
    $mail->SMTPAuth = true;  // Autenticação ativada
    $mail->SMTPSecure = 'tls'; // SSL REQUERIDO pelo GMail
    $mail->Host = 'smtp.gmail.com'; // SMTP utilizado
    $mail->Port = 587;    // A porta 587 deverá estar aberta em seu servidor
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom($de, $de_nome);
    $mail->Subject = $assunto;
    $mail->Body = $corpo;
    $mail->AddAddress($para);
    if (!$mail->Send()) {
        $error = 'Mail error: ' . $mail->ErrorInfo;
        return false;
    } else {
        $error = 'Mensagem enviada!';
        return true;
    }
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

if (smtpmailer($Email, 'jennefer.barbosah@gmail.com', 'Jennefer Barbosa', 'Teste de envio para o email', $Vai)) {

    header("location:http://localhost/bookFree/index.php"); // Redireciona para uma página de obrigado.
}
if (!empty($error))
    echo $error;
?>
