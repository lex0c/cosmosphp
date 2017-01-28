<?php

require_once (dirname(dirname(__DIR__)) . '/bootstrap.php');

$sort = cosmos('Cosmos\Collections\Ordinations\BubbleSort');
$list = new \Cosmos\Collections\ArrayList();

$x = 100;
for ($i = 0; $i < 100; $i++) {
    $list->add($x--);
//    $list->add('d');
//    $list->add('e');
//    $list->add('c');
//    $list->add('a');
//    $list->add([23, 43, 65, 865, 346]);
}

//vDump($list);

vDump($sort->sort($list));
