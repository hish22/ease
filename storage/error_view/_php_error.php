<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #ffffff;
            text-align: center;
            padding: 50px;
        }

        .error-container {
            background: #2c2c3a;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
            max-width: 600px;
            text-align: left;
        }

        .error-icon {
            font-size: 50px;
            color: #ff4c4c;
        }

        .error-title {
            font-size: 24px;
            font-weight: bold;
            color: #ff4c4c;
        }

        .error-details {
            margin-top: 15px;
            font-size: 18px;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 5px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">⚠️</div>
        <div class="error-title">PHP Error Detected</div>
        <div class="error-details">
            <strong>Message:</strong> <?= htmlspecialchars($message ?? "Unknown Error") ?><br>
            <strong>File:</strong> <?= htmlspecialchars($file ?? "Unknown File") ?><br>
            <strong>Line:</strong> <?= htmlspecialchars($line ?? "Unknown Line") ?>
        </div>
    </div>
</body>
</html>
