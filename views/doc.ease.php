<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
   //<h1>~{echo 'hello world'}</h1>
   <h1> ~print('Hello world')</h1>
   ~if(4>2)
        <h1>~print('yes')</h1> 
   ~endif
    <?php $nums = [1,2,3] ?> 
    ~filter([0,1,2,3,4] as $num => $num < 1)
        ~print($num)
    ~endfilter
</body>
</html>