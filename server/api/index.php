<?php
header('Content-Type: application/json');
include ('../app/RestServer.php');
$c = new RestServer();
echo json_encode($c->run());
