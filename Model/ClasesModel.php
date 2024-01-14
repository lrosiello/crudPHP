<?php

class ClasesModel{
 
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=sistema_clases;charset=utf8','root','');
    }

    public function getClases(){
        $sentencia = $this->db->prepare('SELECT * FROM clases');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ); 
    }

    public function getClaseById($id_clase){
        $sentencia = $this->db->prepare('SELECT * FROM clases WHERE id=?');
        $sentencia->execute(array($id_clase));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function insertClase($nombre){
        $sentencia = $this->db->prepare('INSERT INTO clases(nombre) VALUES(?)');
        $sentencia->execute(array($nombre));
        return $sentencia->rowCount();
    }

    public function editClase($id_clase, $nombre){
        $sentencia = $this->db->prepare('UPDATE clases SET nombre=? WHERE id=?');
        $sentencia->execute(array($nombre,$id_clase));
    }

    public function deleteClase($id_clase){
        $sentencia = $this->db->prepare('DELETE FROM clases WHERE id=?');
        $sentencia->execute(array($id_clase));
    }


}

