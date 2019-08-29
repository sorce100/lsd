<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
// database connection
require '../src/config/db.php';
// for members
require '../src/routes/members.php';
$app->run();
