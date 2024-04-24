<?php 
    require_once "./ClasesMVC/ClasesModel.php";
    require_once "./ClasesMVC/ClasesView.php";
    Class ClasesController{

        private $model;
        private $view;

        public function __construct(){
            $this->model = new ClasesModel();
            $this->view = new ClasesView();
        }

        public function getClases(){
            $clases = $this->model->getClases();
            if(!$clases){
                $this->view->showMessage("no se han encontrado datos");
                return;
            }
            $this->view->showClases($clases);
        }

        public function getClaseById($params = null){
            if(!isset($params[":ID"])){
                $this->view->showMessage("no se encuentra el id");
                return;
            }
            $id_clase = $params[":ID"];
            $clase = $this->model->getClaseById($id_clase);
            if(!$clase){
                $this->view->showMessage("no existe esta clase");
                return;
            }
            $this->view->showClaseById($clase);
        }

        public function addClase(){
            if(!isset($_POST["input_nombre"]) || !isset($_POST["input_descripcion"])){
                $this->view->showMessage("asegurate de tener todos los campos llenos");
                return;
            }
            $nombre = $_POST["input_nombre"];
            $descripcion = $_POST["input_descripcion"];
            $claseAdded = $this->model->addClase($nombre, $descripcion);
            if($claseAdded>0){
                $this->view->showMessage("elemento ingresado satisfactoriamente");
            }
        }

        public function editClase($params = null){
            if(!isset($_POST["input_nombre"]) || !isset($_POST["input_descripcion"])){
                $this->view->showMessage("asegurate de tener todos los campos llenos");
                return;
            }
            $nombre = $_POST["input_nombre"];
            $descripcion = $_POST["input_descripcion"];
            $id_clase = $params[":ID"];
            $editedClase = $this->model->editClase($nombre, $descripcion, $id_clase);
            if($editedClase>0){
                $this->view->showMessage("error al modificar la clase");
            }
        }

        public function deleteClase($params = null){
            if(!isset($params[":ID"])){
                $this->view->showMessage("no esta seteado el id");
                return;
            }
            $id_clase = $params[":ID"];
            $deleting = $this->model->deleteClase($id_clase);
            if($deleting>0){
                $this->view->showMessage("clase eliminada satisfactoriamente");
            }
        }


    }