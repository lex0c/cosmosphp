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
$list->add([
    'sdsfg' => 'gerb',
    'wdfir' => 2443
]);

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
$list2->add(235354);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

$list2->merge($list);

$list2->set(7, 'blue');
$list2->addIn(8, '23df346456g');
$list2->addIn(2, '2sdfs3dfg');
$list2->add('blue', true);

echo "<br>";
echo "<br>";

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

//vDump($list2->contains('23dfg'));
//vDump($list2->indexOf(235354));

echo "<br>";
echo "<br>";

//vDump($list2->lastIndexOf('blue'));
$list2->remove(13);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list2->removeByElement('blue', true, true);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$list2->removeRange(2, 6);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

echo "<br>";
echo "<br>";

$subList = $list2->subList(1, 4);

echo "<pre>";
print_r($subList);
echo "</pre>";

echo "<br>";
echo "<br>";

$list2->add([23, 43, 43, 64, 7], false, false);
$list2->addIn(4, [false]);
$list2->set(8, 'sdgefer');
$list2->add(235365757);

$list2->remove(8);

echo "<pre>";
print_r($list2->getAll());
echo "</pre>";

//vDump($list2->get(4));

