<?php

require_once (dirname(dirname(__DIR__)) . '/bootstrap.php');
use \Cosmos\Security\Encryption\Hash;

$hash = new Hash();

$en = $hash->generate('adkgsoigjsrihjih');

var_dump($en);

echo "<br>";

var_dump($hash->isEquals('adkgsoigjsrihjih', $en));
