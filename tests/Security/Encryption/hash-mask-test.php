<?php

require_once (dirname(dirname(__DIR__)) . '/bootstrap.php');
use \Cosmos\Security\Encryption\HashMask;

$encrypt = new HashMask();

$en = $encrypt->disguise('Hahahahah');
var_dump($en);

echo '<br>';

var_dump($encrypt->retrieve($en));
