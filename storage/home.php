<?php $a = 5; $b = true; $home = 1; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="hidden" value="HEAD" name="_method">
<input type="hidden" value="PUT" name="_method">
<input type="hidden" value="PATCH" name="_method">
<?php include 'storage/about.php' ?>
<?= "WELCOME", $home ?>
<?php if($a > 2): ?>
<?php if((4 > 2) || 3 > 1): ?>
            Hello world
<?php endif ?>
<?php endif ?>

<?php if($a > 4): ?>
        Yes dude
<?php endif ?>

    
<?php if(true): ?>
        hidw
<?php endif ?>

<?php if(true): ?>
<?php if(TRUE): ?>
            hi
<?php endif ?>
<?php endif ?>
    
<?php if(true): ?>
<?php if(true): ?>
        <p>Test</p>
<?php endif ?>
<?php endif ?>

</body>
</html>