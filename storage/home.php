<?php $a = 3; $b = true ?>
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

<?php if($a > 2): ?>
<?php if(4 > 2 || 3 > 1): ?>
<?php if($b == true): ?>
                <h1>Hello world</h1>
<?php endif ?>
<?php endif ?>
<?php endif ?>

</body>
</html>