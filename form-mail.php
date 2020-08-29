<?php
    header('Content-Type: text/html; charset=utf-8');
    require 'mailer/PHPMailerAutoload.php';

    $email = $_POST['email'];
    $salto = "<br/>";

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/y"); //pega a data
    $hora = date("H:i"); //pega a hora
    $premsg = ('Este é um formulário enviado apartir do site: marcia.com.br'.$salto.'Enviado ás: '.$hora.' do dia '.$data.''.$salto);
    $corpo2 = "
        $premsg 
        $salto 
        Email:\n $email $salto 
    ";

    if($email == null){
        echo "<script>alert('Preencha o campo de email corretamente.');history.back();</script>";
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
        $mail-> Username = "marcia@outlook.com";
        $mail-> Password = "MINHA-SENHA"; //recuperar-senha da conta de email
        $mail-> SetFrom('marcia@outlook.com', 'Contate-nos'); //Enviado por...
        $mail-> AddAddress ("marcia@outlook.com"); //Enviar para...
        $mail-> Subject = ('Formulário de Contato [Email Marketing]');
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