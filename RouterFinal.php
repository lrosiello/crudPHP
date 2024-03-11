<?php

require_once './Controller/UsuariosController.php';
require_once './Controller/EmpresasController.php';
require_once './Controller/PedidosController.php';
require_once './RouterClass.php';



define ("BASE_URL", '//'.$_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]).'/');

$r = new Router();


/////////////////////////////////USUARIOS///////////////////////////////
$r->addRoute("usuarios", "GET", "UsuariosController", "getUsuarios"); 
$r->addRoute("usuarios/:ID", "GET", "UsuariosController", "getUsuarioById");
$r->addRoute("insertUsuario", "POST","UsuariosController", "insertUsuario");
$r->addRoute("deleteUsuario/:ID", "GET", "UsuariosController", "deleteUsuario"); 
$r->addRoute("showEditUsuario/:ID", "GET", "UsuariosController", "showEditUsuario");
$r->addRoute("editUsuario/:ID", "POST", "UsuariosController", "editUsuario");
/////////////////////////////////EMPRESAS///////////////////////////////
$r->addRoute("empresas", "GET", "EmpresasController", "getEmpresas"); 
$r->addRoute("empresas/:ID", "GET", "EmpresasController", "getEmpresaById");
$r->addRoute("insertEmpresa", "POST", "EmpresasController", "insertEmpresa");
$r->addRoute("deleteEmpresa/:ID", "GET", "EmpresasController", "deleteEmpresa"); 
$r->addRoute("showEditEmpresa/:ID", "GET", "EmpresasController", "showEditEmpresa");
$r->addRoute("editEmpresa/:ID", "POST", "EmpresasController", "editEmpresa");

/////////////////////////////////PEDIDOS///////////////////////////////
$r->addRoute("pedidos", "GET", "PedidosController", "getPedidos"); 
$r->addRoute("pedidos/:ID", "GET", "PedidosController", "getPedidoById");
$r->addRoute("insertPedido", "POST", "PedidosController", "insertPedido");
$r->addRoute("deletePedido/:ID", "GET", "PedidosController", "deletePedido"); 
$r->addRoute("showEditPedido/:ID", "GET", "PedidosController", "showEditPedido");
$r->addRoute("editPedido/:ID", "POST", "PedidosController", "editPedido");


/////////////////////////////////VALORACIONES///////////////////////////////
$r->addRoute("valoraciones", "GET", "ValoracionesController", "getValoraciones"); 
$r->addRoute("valoraciones/:ID", "GET", "ValoracionesController", "getValoracionById");
$r->addRoute("insertValoracion", "POST", "ValoracionesController", "insertValoracion");
$r->addRoute("deleteValoracion/:ID", "GET", "ValoracionesController", "deleteValoracion"); 
$r->addRoute("showEditValoracion/:ID", "GET", "ValoracionesController", "showEditValoracion");
$r->addRoute("editValoracion/:ID", "POST", "ValoracionesController", "editValoracion");



//RUN
$r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
