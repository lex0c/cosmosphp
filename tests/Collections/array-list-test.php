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
$list->addIn(5, 4365676);
$list->addIn(0, 'sgrds');
$list->addIn(7, '23dfg');

echo "<pre>";
print_r($list->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list->set(3, 155);

echo "<pre>";
print_r($list->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list2 = new ArrayList();
$list2->add('blue');
$list2->add('blue', true);
$list2->add(235354);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

$list2->merge($list);
$list2->set(0, 1455);

echo "<br>";
echo "<br>";

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

//vDump($list2->contains('23dfg'));
//vDump($list2->indexOf(235354));
