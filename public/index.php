<?php

// use Bcchicr\StudentList\Container\Container;

use Bcchicr\StudentList\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = Request::captureGlobals();


echo $request->getMethod();
// xdebug_info();

// $container = Container::getInstance();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/" method="post">
        <input type="text" name="colors[]">
        <input type="text" name="colors[]">
        <input type="text" name="colors[]">
        <button type="submit">submit</button>
    </form>
</body>

</html>