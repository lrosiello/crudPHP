<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "./RouterFinal.php";
require_once "./Model/EmpresasModel.php";
require_once "./View/EmpresasView.php";
require_once "./View/EmpresaEditView.php";

class EmpresasController
{
    private $model;
    private $view;
    private $editView;
    public function __construct()
    {
        $this->model = new EmpresasModel();
        $this->view = new EmpresasView();
        $this->editView = new EmpresaEditView();
    }

    public function getEmpresas()
    {
        $empresas = $this->model->getEmpresas();
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
        $this->editView->showEditEmpresa($empresa);
    }
    public function insertEmpresa()
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre']) || 
            !isset($_POST['input_direccion']) || empty($_POST['input_direccion']) ||
            !isset($_POST['input_premium']) || !in_array($_POST['input_premium'], ['true', 'false'])){
            echo("asegurate de llenar todos los campos correctamente, proceso abortado");
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
            echo("asegurate de llenar todos los campos correctamente, proceso abortado");
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

}

