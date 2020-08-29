<?php
    header('Content-Type: text/html; charset=utf-8');
    require 'mailer/PHPMailerAutoload.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $celular = $_POST['celular'];
    $assunto = $_POST['assunto'];
    $msg = $_POST['msg'];

    $salto = "<br/>";

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/y"); //pega a data
    $hora = date("H:i"); //pega a hora
    $localizacao = 'Identificação do formulário: Contato '.$salto.'Local de envio: CONTATO'.$salto;
    $premsg = ('Este é um formulário enviado apartir do site: marciaamorimbolos.com.br'.$salto.'Enviado ás: '.$hora.' do dia '.$data.''.$salto);
    $corpo2 = "
        $localizacao 
        $salto 
        $premsg 
        $salto 
        Enviado por:\n $nome $salto 
        Celular:\n $celular $salto 
        Email:\n $email $salto 
        Endereço:\n $endereco $salto 
        Assunto:\n $assunto $salto 
        Mensagem:\n $msg
    ";

    if($nome == null || $email == null || $endereco == null || $celular == null || $assunto == null || $msg == null){
        echo "<script>alert('Preencha todos os campos corretamente.');history.back();</script>";
        exit;
    }

    try
    {
        $mail = new PHPMailer();
        $mail-> SetLanguage("pt-br");
        $mail-> IsSMTP();
        $mail-> IsHTML(true);
        $mail-> CharSet = 'UTF-8';
        $mail-> SMTPSecure = 'tls';
        $mail-> SMTPAuth = (true);
        $mail-> Port = 587;
        $mail-> Host = 'smtp-mail.outlook.com';
        $mail-> Username = "marciaamorimbolos@outlook.com";
        $mail-> Password = "#OK3twpt"; //recuperar-senha da conta de email
        $mail-> SetFrom('marciaamorimbolos@outlook.com', 'Contate-nos');//Enviado por...

        $mail-> AddAddress ("marciaamorimbolos@outlook.com");//Enviar para...
        $mail-> Subject = ('Formulário de Contato');
        $mail-> MsgHTML ($corpo2);

        if($mail->send())
        {
            echo "<script>alert('E-mail enviado com sucesso. Em breve nossa equipe entrará em contato com você!')</script>";
            echo "<script>window.location = 'index.html';</script>";
            exit;
        }
        else
        {
            echo "<script>alert('Erro ao enviar o e-mail [error 0x0001].')</script>";
            echo "<script>window.location = 'index.html';</script>";
            exit;
        }
    }
    catch(Exception $e)
    {
        echo "<script>alert('Erro ao enviar o e-mail [error 0x0002].')</script>";
        echo "<script>window.location = 'index.html';</script>";
        exit;
    }

?>