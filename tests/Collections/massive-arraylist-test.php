<?php

require_once (dirname(__DIR__) . '/bootstrap.php');
use \Cosmos\Collections\ArrayList;

$list = new ArrayList();

for ($i = 0; $i <= 10000; $i++) {
    $list->add(mt_rand(0, mt_getrandmax()), true);
}

foreach ($list->getAll() as $x) {
    echo $x;
    echo "<br>";
}
