<?php
include ('../../app/RestServer.php');

$c = new RestServer();
echo $c->run();

//echo $_SERVER['REQUEST_URI'];

