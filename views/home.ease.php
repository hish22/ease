<?php $a = 5; $b = true; $home = 1; ?>
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
    ~INCLUDE about
    <h1> ~PRINT("WELCOME", $home) </h1>
    ~IF($a > 2)
        ~IF ((4 > 2) || 3 > 1)
            Hello world
        ~ENDIF
    ~ENDIF

    ~IF($a > 4)
        Yes dude
    ~ENDIF

    
    ~IF(true)
        hidw
    ~ENDIF

    ~IF(true)
        ~IF(TRUE)
            hi
        ~ENDIF
    ~ENDIF
    
    ~IF(true)
    ~IF(true)
        <p>Test</p>
    ~ENDIF
    ~ENDIF

</body>
</html>