<?php 

    Class ClasesModel{

        private $db;


        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=sistema_clases;charset=utf8', 'root', '');
            
        }

        public function getClases(){
            $sentencia = $this->db->prepare("SELECT * FROM clases");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function getClaseById($id_clase){
            $sentencia = $this->db->prepare("SELECT * FROM clases WHERE id=?");
            $sentencia->execute(array($id_clase));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }

        public function addClase($nombre, $descripcion){
            $sentencia = $this->db->prepare("INSERT INTO clases(nombre,descripcion) VALUES (?,?)");
            $sentencia->execute(array($nombre, $descripcion));
            return $sentencia->rowCount();
        }

        public function editClase($nombre, $descripcion, $id_clase){
            $sentencia = $this->db->prepare("UPDATE clases SET nombre=?, descripcion=? WHERE id=?");
            $sentencia->execute(array($nombre, $descripcion, $id_clase));
            return $sentencia->rowCount();
        }

        public function deleteClase($id_clase){
            $sentencia = $this->db->prepare("DELETE from clases WHERE id=?");
            $sentencia->execute(array($id_clase));
            return $sentencia->rowCount();
        }
    }