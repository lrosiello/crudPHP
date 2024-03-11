<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "./RouterFinal.php";
require_once "./Model/PedidosModel.php";
require_once "./View/PedidosView.php";
require_once "./View/PedidoEditView.php";

class PedidosController
{
    private $model;
    private $view;
    private $editView;

    public function __construct()
    {
        $this->model = new PedidosModel();
        $this->view = new PedidosView();
        $this->editView = new PedidoEditView();
    }


    public function getPedidos()
    {
        $usuariosModel = new UsuariosModel();
        $empresasModel = new EmpresasModel();
        $usuarios = $usuariosModel->getUsuarios();
        $empresas = $empresasModel->getEmpresas();

        $pedidos = $this->model->getPedidos();
        foreach ($pedidos as $pedido) {
            //PHP PERMITE DINAMICAMENTE CREAR PROPIEDADES
            $pedido->nombre_usuario = $this->getUsuarioNombre($usuarios, $pedido->id_usuario);
            $pedido->nombre_empresa = $this->getEmpresaNombre($empresas, $pedido->id_empresa);
        }

        $this->view->showPedidos($pedidos, $usuarios, $empresas);
    }


    public function getPedidoById($params = null)
    {
        if (!isset($params[':ID'])) {
            return "el id no existe";
        }
        $id_pedido = $params[':ID'];
        $pedido = $this->model->getPedidoById($id_pedido);
        echo json_encode($pedido);
    }

    public function showEditPedido($params = null)
    
    {
        $usuariosModel = new UsuariosModel();
        $empresasModel = new EmpresasModel();
        $usuarios = $usuariosModel->getUsuarios();
        $empresas = $empresasModel->getEmpresas();

        $pedidos = $this->model->getPedidos();
        foreach ($pedidos as $pedido) {
            //PHP PERMITE DINAMICAMENTE CREAR PROPIEDADES
            $pedido->nombre_usuario = $this->getUsuarioNombre($usuarios, $pedido->id_usuario);
            $pedido->nombre_empresa = $this->getEmpresaNombre($empresas, $pedido->id_empresa);
        }
        if (!isset($params[':ID'])) {
            return "el id no existe";
        }
        $id_pedido = $params[':ID'];
        $pedido = $this->model->getPedidoById($id_pedido);
        $this->editView->showEditPedido($pedido, $usuarios, $empresas);

    }

    public function insertPedido()
    {
        if (
            !isset($_POST['input_id_usuario']) || empty($_POST['input_id_usuario']) ||
            !isset($_POST['input_id_empresa']) || empty($_POST['input_id_empresa']) ||
            !isset($_POST['input_pedido']) || empty($_POST['input_pedido']) ||
            !isset($_POST['input_fecha']) || empty($_POST['input_fecha'])
        ) {
            echo ("asegurate de llenar todos los campos correctamente, proceso abortado");
            return;
        }

        // Verificar existencia de usuario y empresa
        $usuarioExists = $this->model->checkUserExists($_POST['input_id_usuario']);
        $empresaExists = $this->model->checkEmpresaExists($_POST['input_id_empresa']);

        if (!$usuarioExists || !$empresaExists) {
            echo ("el usuario o empresa especificados no existen, proceso abortado");
            return;
        }

        $this->model->insertPedido($_POST['input_id_usuario'], $_POST['input_id_empresa'], $_POST['input_pedido'], $_POST['input_fecha']);
        header('Location: http://localhost/repaso/pedidos');
        exit();
    }

    public function editPedido($params = null)
    {
        if (
            !isset($_POST['input_id_usuario']) || empty($_POST['input_id_usuario']) ||
            !isset($_POST['input_id_empresa']) || empty($_POST['input_id_empresa']) ||
            !isset($_POST['input_pedido']) || empty($_POST['input_pedido']) ||
            !isset($_POST['input_fecha']) || empty($_POST['input_fecha'])
        ) {
            echo ("asegurate de llenar todos los campos correctamente, proceso abortado");
            return;
        }

        // Verificar existencia de usuario y empresa
        $usuarioExists = $this->model->checkUserExists($_POST['input_id_usuario']);
        $empresaExists = $this->model->checkEmpresaExists($_POST['input_id_empresa']);

        if (!$usuarioExists || !$empresaExists) {
            echo ("el usuario o empresa especificados no existen, proceso abortado");
            return;
        }

        $id_pedido = $params[':ID'];
        $this->model->editPedido($id_pedido, $_POST['input_id_usuario'], $_POST['input_id_empresa'], $_POST['input_pedido'], $_POST['input_fecha']);
        header('Location: http://localhost/repaso/pedidos');
        exit();
    }

    public function deletePedido($params = null)
    {
        $id_pedido = $params[':ID'];
        $this->model->deletePedido($id_pedido);
        header('Location: http://localhost/repaso/pedidos');
        exit();
    }


    private function getUsuarioNombre($usuarios, $id_usuario)
    {
        foreach ($usuarios as $usuario) {
            if ($usuario->id == $id_usuario) {
                return $usuario->nombre;
            }
        }
        return "Usuario no encontrado";
    }

    private function getEmpresaNombre($empresas, $id_empresa)
    {
        foreach ($empresas as $empresa) {
            if ($empresa->id == $id_empresa) {
                return $empresa->nombre;
            }
        }
        return "Empresa no encontrada";
    }
}
