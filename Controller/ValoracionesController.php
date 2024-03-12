<?php

require_once "./Model/ValoracionesModel.php";
require_once "./View/ValoracionesView.php";
require_once "./View/ValoracionesInadecuadas.php";
require_once './libs/isLogged.php';

class ValoracionesController
{

    private $model;
    private $view;
    private $inadecuadasView;

    public function __construct()
    {
        $this->model = new ValoracionesModel();
        $this->view = new ValoracionesView();
        $this->inadecuadasView = new ValoracionesInadecuadas();
    }

    public function getValoraciones()
    {
        $usuariosModel = new UsuariosModel();
        $empresasModel = new EmpresasModel();
        $usuarios = $usuariosModel->getUsuarios();
        $empresas = $empresasModel->getEmpresas();

        $valoraciones = $this->model->getValoraciones();
        foreach ($valoraciones as $valoracion) {
            $valoracion->nombre_usuario = $this->getUsuarioNombre($usuarios, $valoracion->id_usuario);
            $valoracion->nombre_empresa = $this->getEmpresaNombre($empresas, $valoracion->id_empresa);
        }

        $this->view->showValoraciones($valoraciones, $usuarios, $empresas);
    }


    public function insertValoracion()
    {

        if (!isLogged()) { //verifica si esta logueado
            exit();
        }

        if (
            !isset($_POST["input_id_empresa"]) || !isset($_POST["input_id_usuario"]) || !isset($_POST["input_valoracion"])
            || !isset($_POST["input_resena"]) || !isset($_POST["input_inadecuada"])
        ) {
            echo ('asegurese de que todos los datos esten ingresados');
        }

        // Verificar si el usuario ya ha valorado la empresa anteriormente
        if ($this->model->usuarioHaValoradoEmpresa($_POST["input_id_empresa"], $_POST["input_id_usuario"])) {
            echo ('El usuario ya ha valorado esta empresa anteriormente');
            exit();
        }

           // Verificar si el usuario ha realizado un pedido en la empresa anteriormente
           if (!$this->model->usuarioHaRealizadoPedidoEnEmpresa($_POST["input_id_empresa"], $_POST["input_id_usuario"])) {
            echo('El usuario no ha realizado un pedido en esta empresa anteriormente');
            exit();
        }

        $this->model->insertValoracion(
            $_POST["input_id_empresa"],
            $_POST["input_id_usuario"],
            $_POST["input_valoracion"],
            $_POST["input_resena"],
            $_POST["input_inadecuada"]
        );
        header("location:http://localhost/repaso/valoraciones");
        exit();
    }

    public function setPremium(){
        if (!isLogged()) { //verifica si esta logueado
            exit();
        }
        if(!isAdmin()){ //verifica si es administrador
            exit();
        }
        $insertedVal = $_POST["input_set_premium_value"]; //input del form
        $this->model->marcarEmpresasComoPremium($insertedVal); //modelo de valoraciones
        header('Location: http://localhost/repaso/empresas'); //vuelvo a la vista de empresas
        exit();
    }

    
    public function selectInadecuadas(){
        if (!isLogged()) { // Verifica si está logueado
            exit();
        }
        if(!isAdmin()){ // Verifica si es administrador
            exit();
        }
        $usuariosInadecuadas = $this->model->getUsuariosInadecuadas();
        $valoracionesInadecuadas = $this->model->getValoracionesInadecuadas();
        $this->inadecuadasView->showUsuariosInadecuadas($usuariosInadecuadas, $valoracionesInadecuadas);
    }
    

    public function deleteValoracion($params = null)
    {
        $id_valoracion = $params[':ID'];
        $this->model->deleteValoracion($id_valoracion);
        header('Location: http://localhost/repaso/valoraciones');
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
