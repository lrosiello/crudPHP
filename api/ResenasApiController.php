<?php

    require_once "./Model/ValoracionesModel.php";
    require_once "./api/ApiView.php";
    require_once './api/ApiController.php';
    Class ResenasApiController extends ApiController{

        public function __construct(){
            parent::__construct();
            $this->apiView = new ApiView();
            $this->model = new ValoracionesModel();
        }


        public function getResenasPorEmpresa(){
            $id_empresa = $_POST['input_id_empresa'];
            if($id_empresa){
                $resenasPorEmpresa = $this->model->getResenasPorEmpresa($id_empresa);
                $this->apiView->response($resenasPorEmpresa, 200);
            }else{
                $this->apiView->response("la empresa no existe", 200);
            }
            
        }

        public function editResena($params = null) {
            $id_resena = $params[":ID"];
            $inputData = $this->getData();
            $resena = $this->model->getValoracionById($id_resena);
        
            if ($resena && $resena->id_usuario == $inputData['id_usuario']) { //verifica que la resena la haya hecho yo
                $this->model->editarValoracion($id_resena, $inputData['valoracion'], $inputData['resena'], $inputData['inadecuada']);
                $this->apiView->response("Reseña editada correctamente", 200);
            } else {
                $this->apiView->response("La reseña no existe o no tienes permisos para editarla", 404);
            }
        }
        

    }