<?php   

	if (isset($_POST['nome']) && !empty($_POST['nome'])) {
		$nome = $_POST['nome'];
	}

	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$email = $_POST['email'];
	}

	if (isset($_POST['assunto']) && !empty($_POST['assunto'])) {
		$assunto = $_POST['assunto'];
	}

	if (isset($_POST['mensagem']) && !empty($_POST['mensagem'])) {
		$mensagem = nl2br($_POST['mensagem']);
	}
	
    $serverEmail = 'madeira@smenergia.com.br';
    $serverSenha = 'smenergia10';
    $serverNome = 'Website | SM.energia';

    $enviaNome = 'SM.energia';
    $enviaEmail = 'madeira@smenergia.com.br';

    $msg = 'Mensagem enviada do site SM.energia'.'<br />';
    $msg .= '________________________________________________________'.'<br /><br />';
    $msg .= 'Nome: '.$nome.'<br />';
    $msg .= 'E-mail: '.$email.'<br />';
    $msg .= 'Assunto: '.$assunto.'<br />';
    $msg .= '________________________________________________________'.'<br /><br />';
    $msg .= 'Mensagem: "<br />'.$mensagem.'"<br />';

    require_once('../lib/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Charset = 'utf8_decode()';
    $mail->Host = 'smtp.'.substr(strstr($serverEmail, '@'), 1);
    $mail->Port = '587';
    $mail->Username = $serverEmail;
    $mail->Password = $serverSenha;
    $mail->From = $serverEmail;
    $mail->FromName = utf8_decode($serverNome);
    $mail->IsHTML(true);
    $mail->Subject = utf8_decode($assunto);
    $mail->Body = utf8_decode($msg);

    $mail->AddAddress($enviaEmail, utf8_decode($enviaNome));

    if (!$mail->Send()) {
        echo 'Erro ao enviar mensagem: '. print($mail->ErrorInfo);
    }else {
        echo 'Mensagem enviada com sucesso';
    }
?>
