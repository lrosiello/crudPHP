<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "./RouterFinal.php";
require_once "./Model/ClasesModel.php";

class ClasesController
{

    private $model;

    public function __construct()
    {
        $this->model = new ClasesModel();
    }

    public function getClases()
    {
        $clases = $this->model->getClases();
        header('Content-Type: application/json');
        echo json_encode($clases);
    }



    public function getClaseById($params = null)
    {
        if (!isset($params[':ID'])){
            return "el id no existe";
        }
        $id_clase = $params[':ID'];
        $clase = $this->model->getClaseById($id_clase);
        echo json_encode($clase);
    }

    public function insertClase()
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre'])){
            echo("no has ingresado ningun nombre, proceso abortado");
            return;
        }

        $this->model->insertClase($_POST['input_nombre']);
        header('Location: http://localhost/repaso/index.php');
        exit();
    }

    public function editClase($params = null)
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre'])){
            echo("no has ingresado ningun nombre, proceso abortado");
            return;
        }

        $id_clase = $params[':ID'];
        $this->model->editClase($id_clase, $_POST["input_nombre"]);
        header('Location: http://localhost/repaso/index.php');
        exit();
    }
    public function deleteClase($params = null)
    {
        $id_clase = $params[':ID'];
        $this->model->deleteClase($id_clase);
        header('Location: http://localhost/repaso/index.php');
        exit();
    }
}
