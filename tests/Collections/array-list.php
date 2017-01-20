<?php

require_once (dirname(__DIR__) . '/bootstrap.php');

use \Tests\Collections\Stupids\StupidClass;
use \Cosmos\Collections\ArrayList;

$list = new ArrayList();

$list->add(12);
$list->add('hello');
$list->add('15');
$list->add(11.23);
$list->add(new StupidClass());

echo "<pre>";
print_r($list->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list->addIn(2, 'world');
$list->addIn(7, 'aaaaa');
$list->addIn(6, 4365676);
$list->addIn(8, 4365676);

echo "<pre>";
print_r($list->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list->set(3, 155);

echo "<pre>";
print_r($list->getAll());
echo "</pre>";





