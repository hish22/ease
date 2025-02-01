<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        body{
            background-color: #121212;
            color: white;
            font-family: sans-serif;
            text-align: center;
        }
        
        #error_msg{
            font-size: 50px;
        }

        #line_of_error{
            font-size: 30px;
        }
    </style>
</head>
<body>
    <img src="assets/ease_0.1logo.png"/>
        <?php

            use Engine\Summon\Extracter;

            Extracter::print_noease_error();
        
        ?>
</body>
</html>