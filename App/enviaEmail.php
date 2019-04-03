
<?php
    require 'vendor/autoload.php';
    

    if( $_POST['nome'] =='' || $_POST['email'] == '' || $_POST['especialidade'] ='' || $_POST['data'] =='' || $_POST['periodo'] =='' || $_POST['telefone'] ==''){
        echo 1; // preencha todos os campos por favor, e certifique-se de colocar a data e horário completos
        exit();
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
        echo 2; // email inválido 
        exit();
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $especialidade = $_POST['especialidade'];
    $data = $_POST['data'];
    $periodo = $_POST['periodo'];
    $mensagem = $_POST['telefone'];

    $from = new SendGrid\Email(null, "eignacio403@gmail.com");
    $subject = "Agendamento de consulta";
    $to = new SendGrid\Email(null, "eignacio403@gmail.com");
    $content = new SendGrid\Content("text/html", "Olá Administrador, <br><br>
    Foi solicitada uma nova consulta, por favor verifique os dados abaixo<br><br>
    Nome: $nome<br>
    Email: $email<br>
    Especialidade: $especialidade<br>
    Data: $data<br>
    Periodo: $periodo<br>
    Mensagem: $mensagem<br>
    ");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    //Necessário inserir a chave
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo 'sucess';
?>

