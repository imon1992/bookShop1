<?php
include ('../../app/RestServer.php');

$c = new RestServer();
echo json_encode($c->run());

//echo $_SERVER['REQUEST_URI'];

