<?php $a = 3; $b = true; $home = 1; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ~HEAD
    ~PUT
    ~PATCH
    <h1> ~PRINT("WELCOME", $home) </h1>
    ~IF($a > 2)
        ~IF ((4 > 2) || 3 > 1)
            ~IF ($b == true)
                <h1>Hello world</h1>
            ~ENDIF
        ~ENDIF
    ~ENDIF

</body>
</html>