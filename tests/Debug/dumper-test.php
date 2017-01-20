<?php

require_once (dirname(__DIR__) . '/bootstrap.php');

$user = new stdClass();
$user->name = 'Léo';
$user->age = 23;
$user->city = 'SJC';
$user->x = [
    'hello' => 'Hello World!',
    'Something' => 'Yeah..',
    'My x' => [
        1, 2, 3, 4, 5, 6, 7
    ]
];

vDump($user);