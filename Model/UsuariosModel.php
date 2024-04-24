<?php

class UsuariosModel{
 
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=teneloya;charset=utf8','root','');
    }

    public function getUsuarios(){
        $sentencia = $this->db->prepare('SELECT * FROM usuario');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ); 
    }

    public function getUsuarioById($id_usuario){
        $sentencia = $this->db->prepare('SELECT * FROM usuario WHERE id=?');
        $sentencia->execute(array($id_usuario));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getUsuarioByEmail($email){
        $sentencia = $this->db->prepare('SELECT * FROM usuario WHERE email=?');
        $sentencia->execute(array($email));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function insertUsuario($nombre,$email,$pass){
        $sentencia = $this->db->prepare('INSERT INTO usuario(nombre,email,password) VALUES(?,?,?)');
        $sentencia->execute(array($nombre,$email,$pass));
        return $sentencia->rowCount();
    }

    public function editUsuario($id_usuario, $nombre, $email, $pass){
        $sentencia = $this->db->prepare('UPDATE usuario SET nombre=?, email=?, password=? WHERE id=?');
        $sentencia->execute(array($nombre, $email, $pass, $id_usuario));
    }
    

    public function deleteUsuario($id_usuario){
        $sentencia = $this->db->prepare('DELETE FROM usuario WHERE id=?');
        $sentencia->execute(array($id_usuario));
    }


}

