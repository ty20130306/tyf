<?php

$formater = new YourFormater();
$mapper = new YourMapper(your/dir/to/cmd);
$game = new Tyf($mapper, $formater);
$tyfOutput = $game->run($rawDataArr);
