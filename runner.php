<?php
include 'vendor/autoload.php';

use NumNum\NumNum;

$numnum = new NumNum();

$special = $numnum->findSpecial();
var_dump($special);
