<?php

use Bcchicr\StudentList\Container\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = Container::getInstance();
$container['one'] = 1;
echo $container['one'];
