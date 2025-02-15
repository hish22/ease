<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg,rgb(196, 45, 70),rgb(179, 61, 78));
            color: white;
            text-align: center;
        }
        .error-container {
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 80px;
            font-weight: bold;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1><?=$error_code?></h1>
        <p>System Error</p>
        <p><?= $error_msg ?></p>
    </div>
</body>
</html>
