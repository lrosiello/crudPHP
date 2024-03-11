<?php

class EmpresasModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=teneloya;charset=utf8', 'root', '');
    }

    public function getEmpresas() {
        $sentencia = $this->db->prepare('SELECT * FROM empresa');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getEmpresaById($id_empresa) {
        $sentencia = $this->db->prepare('SELECT * FROM empresa WHERE id=?');
        $sentencia->execute(array($id_empresa));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function insertEmpresa($nombre, $direccion, $premium) {
        if($premium == "true"){
            $premium = 1;
        }
        $sentencia = $this->db->prepare('INSERT INTO empresa(nombre, direccion, premium) VALUES(?,?,?)');
        $sentencia->execute(array($nombre, $direccion, $premium));
        return $sentencia->rowCount();
    }

    public function editEmpresa($id_empresa, $nombre, $direccion, $premium) {
        if($premium == "true"){
            $premium = 1;
        }
        $sentencia = $this->db->prepare('UPDATE empresa SET nombre=?, direccion=?, premium=? WHERE id=?');
        $sentencia->execute(array($nombre, $direccion, $premium, $id_empresa));
    }

    public function deleteEmpresa($id_empresa) {
        $sentencia = $this->db->prepare('DELETE FROM empresa WHERE id=?');
        $sentencia->execute(array($id_empresa));
    }
}
