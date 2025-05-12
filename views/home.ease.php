<?php $a = 5; $b = true; $home = 1; $products = ['apple','orange']; ?>
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
    ~INCLUDE way
    ~INCLUDE test/about
    <h1> ~PRINT("WELCOME", " " ,$name) </h1>
    ~PRINT($a)
    ~IF($a > 2)
        ~IF ((4 > 2) || 3 > 1)
            Hello world
        ~ENDIF
    ~ENDIF

    ~PRINT("welcome"," Honey")

    ~IF($a < 3)
        yup yup
    ~ELSEIF($a > 3)
    ~LOOP($products)
            <br/>
            <p>~PRINT($product)</p>
            <br/>
        ~ENDLOOP
        AHAHAHA
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