<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "./RouterFinal.php";
require_once "./Model/UsuariosModel.php";
require_once "./View/UsuariosView.php";
require_once "./View/UsuarioEditView.php";

class UsuariosController
{
    private $model;
    private $view;
    private $editView;

    public function __construct()
    {
        $this->model = new UsuariosModel();
        $this->view = new UsuariosView();
        $this->editView = new UsuarioEditView();
    }

    function cerrarSesion()
    {
        session_start();
        session_destroy();
    }

    public function login()
{
    if (isset($_POST['input_email']) && isset($_POST['input_password'])) {
        $email = $_POST['input_email'];
        $password = $_POST['input_password'];
        $usuario = $this->model->getUsuarioByEmail($email);

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_start();
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];
            // Puedes añadir más datos a la sesión si lo necesitas
            header('Location: http://localhost/repaso/usuarios');
            exit();
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "Debes ingresar un email y una contraseña";
    }
}

    public function getUsuarios()
    {
        $usuarios = $this->model->getUsuarios();
        $this->view->showUsuarios($usuarios);
    }

    public function getUsuarioById($params = null)
    {
        if (!isset($params[':ID'])){
            return "el id no existe";
        }
        $id_usuario = $params[':ID'];
        $usuario = $this->model->getUsuarioById($id_usuario);
        echo json_encode($usuario);
    }

    public function showEditUsuario($params = null)
    {
        if (!isset($params[':ID'])){
            return "el id no existe";
        }
        $id_usuario = $params[':ID'];
        $usuario = $this->model->getUsuarioById($id_usuario);
        $this->editView->showEditUsuario($usuario);
    }
    public function insertUsuario()
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre']) || 
            !isset($_POST['input_email']) || empty($_POST['input_email']) ||
            !isset($_POST['input_password']) || empty($_POST['input_password'])){
            echo("asegurate de llenar todos los campos, proceso abortado");
            return;
        }

        $this->model->insertUsuario($_POST['input_nombre'],$_POST['input_email'],$_POST['input_password']);
          header('Location: http://localhost/repaso/usuarios');
        exit();
    }

    public function editUsuario($params = null)
    {
        if (!isset($_POST['input_nombre']) || empty($_POST['input_nombre']) || 
            !isset($_POST['input_email']) || empty($_POST['input_email']) ||
            !isset($_POST['input_password']) || empty($_POST['input_password'])){
            echo("asegurate de llenar todos los campos, proceso abortado");
            return;
        }

        $id_usuario = $params[':ID'];
        $this->model->editUsuario($id_usuario, $_POST['input_nombre'],$_POST['input_email'],$_POST['input_password']);
        header('Location: http://localhost/repaso/usuarios');
        exit();
    }
    public function deleteUsuario($params = null)
    {
        $id_usuario = $params[':ID'];
        $this->model->deleteUsuario($id_usuario);
        header('Location: http://localhost/repaso/usuarios');
        exit();
        
    }


}
