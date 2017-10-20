<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE,');
include ('../app/RestServer.php');
$c = new RestServer();
echo json_encode($c->run());
