<?php $a = 5; $b = true; $home = 1; $products = ['apple','orange']; ?>
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
<?php include 'storage/way.php' ?>
<?php include 'storage/about.php' ?>
<?= "WELCOME", " " ,$name ?>
<?= $a ?>
<?php if($a > 2): ?>
<?php if((4 > 2) || 3 > 1): ?>
            Hello world
<?php endif ?>
<?php endif ?>
<?= "welcome"," Honey" ?>

<?php if($a < 3): ?>
        yup yup
<?php elseif($a > 3): ?>
<?php foreach($products as $product): ?>
            <br/>
<?= $product ?>
            <br/>
<?php endforeach ?>
        AHAHAHA
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

<?php foreach($products as $product): ?>
<?php if($product == 'orange'): ?>
<?= $product ?>
<?php endif ?>
<?php endforeach ?>

<?php foreach($users as $user): ?>
<?php if($user > 10): ?>
        <p><?php var_dump($user) ?></p>
<?php endif ?>
<?php endforeach ?>
</body>
</html>