<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Nova mensagem de contato</h2>

    <p><strong>Nome:</strong> {{ $email['name'] }}</p>

    <p><strong>E-mail:</strong> {{ $email['email'] }}</p>

    <p><strong>Assunto:</strong> {{ $email['subject'] }}</p>

    <hr>

    <p>{{ $email['message'] }}</p>
</body>

</html>