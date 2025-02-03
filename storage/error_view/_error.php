<?php use Engine\Summon\Extracter; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-size: 48px;
            margin: 0;
            color: #e63946;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1><?= Extracter::getEaseErrCode() ?></h1>
        <h2><?= Extracter::getEaseErrMsg() ?></h2>
        <p>Something went wrong.</p>
        <p>Some err occurred at: <?= Extracter::getEaseErrFileName() ?>.ease.php</p>
        <p></p>
        <p id='line_of_error'> Line <?=Extracter::getEaseErrLineNumber() ?>: <?= Extracter::getEaseErrLine() ?></p>
    </div>
</body>
</html>
