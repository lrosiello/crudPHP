<?php

require_once './Controller/ClasesController.php';
require_once './RouterClass.php';



define ("BASE_URL", '//'.$_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]).'/');

$r = new Router();

/////////////////////////////////CLASES///////////////////////////////


$r->addRoute("clases", "GET", "ClasesController", "getClases"); 
$r->addRoute("clases/:ID", "GET", "ClasesController", "getClaseById");
$r->addRoute("insertClase", "POST","ClasesController", "insertClase");
$r->addRoute("deleteClase/:ID", "GET", "ClasesController", "deleteClase"); 
$r->addRoute("editClase/:ID", "POST", "ClasesController", "editClase");


//RUN
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);