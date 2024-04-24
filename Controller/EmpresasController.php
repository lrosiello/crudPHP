<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "./RouterFinal.php";
require_once "./Model/EmpresasModel.php";
require_once "./View/EmpresasView.php";
require_once "./View/EmpresaEditView.php";
require_once "./Model/UsuariosModel.php";

class EmpresasController
{
    private $model;
    private $view;
    private $editView;

    private $userModel;
    public function __construct()
    {
        $this->model = new EmpresasModel();
        $this->view = new EmpresasView();
        $this->editView = new EmpresaEditView();
        $this->userModel = new UsuariosModel();
    }

    public function getEmpresas()
    {
        $empresas = $this->model->getEmpresas();
        if(!$empresas){
            $this->view->showError("error al obtener lista");
        }
        $this->view->showEmpresas($empresas);
    }

    public function getEmpresaById($params = null)
    {
        if (!isset($params[':ID'])){
            return "el id no existe";
        }
        $id_empresa = $params[':ID'];
        $empresa = $this->model->getEmpresaById($id_empresa);
        echo json_encode($empresa);
    }

    public function showEditEmpresa($params = null)
    {
        if (!isset($params[':ID'])){
            return "el id no existe";
        }
        $id_empresa = $params[':ID'];
        $empresa = $this->model->getEmpresaById($id_empresa);
        if(!$empresa){
            $this->editView->showError("este id no corresponde a ninguna empresa existente");
            return;
        }
        $this->editView->showEditEmpresa($empresa);
    }
    public function insertEmpresa()
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre']) || 
            !isset($_POST['input_direccion']) || empty($_POST['input_direccion']) ||
            !isset($_POST['input_premium']) || !in_array($_POST['input_premium'], ['true', 'false'])){
            $this->view->showError("asegurate de llenar todos los campos correctamente, proceso abortado");
            return;
        }

        $this->model->insertEmpresa($_POST['input_nombre'],$_POST['input_direccion'],$_POST['input_premium']);
        header('Location: http://localhost/repaso/empresas');
        exit();
    }

    public function editEmpresa($params = null)
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre']) || 
            !isset($_POST['input_direccion']) || empty($_POST['input_direccion']) ||
            !isset($_POST['input_premium']) || !in_array($_POST['input_premium'], ['true', 'false'])){
            $this->view->showError("asegurate de llenar todos los campos correctamente, proceso abortado");
            return;
        }

        $id_empresa = $params[':ID'];
        $this->model->editEmpresa($id_empresa, $_POST['input_nombre'],$_POST['input_direccion'],$_POST['input_premium']);
        header('Location: http://localhost/repaso/empresas');
        exit();
    }

    public function deleteEmpresa($params = null)
    {
        $id_empresa = $params[':ID'];
        $this->model->deleteEmpresa($id_empresa);
        header('Location: http://localhost/repaso/empresas');
        exit();
    }

    public function deleteEmpresaConAdmin($params = null)
{
    session_start();
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['id_usuario'])) {
        $this->view->showError("Usuario no autenticado") ;
        return;
    }

    $id_usuario = $_SESSION['id_usuario'];
    // Verificar si el usuario es administrador
    $usuario = $this->userModel->getUsuarioById($id_usuario);
    if (!$usuario || !$usuario['isAdmin']) {
        $this->view->showError("No tienes permisos para realizar esta acción") ;
        return;
    }

    // Continuar con la eliminación de la empresa
    $id_empresa = $params[':ID'];
    $this->model->deleteEmpresa($id_empresa);
    header('Location: http://localhost/repaso/empresas');
    exit();
}

}

