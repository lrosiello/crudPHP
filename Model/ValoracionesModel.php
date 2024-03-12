<?php

    Class ValoracionesModel {

        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=teneloya;charset=utf8','root','');
        }


        public function getValoraciones(){
            $sentencia = $this->db->prepare("SELECT * from valoracion");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        public function insertValoracion($id_empresa,$id_usuario,$valoracion,$resena,$inadecuada){
            $sentencia = $this->db->prepare("INSERT INTO valoracion(id_empresa,id_usuario,valoracion,resena,inadecuada) VALUES(?,?,?,?,?)");
            $sentencia->execute(array($id_empresa,$id_usuario,$valoracion,$resena,$inadecuada));
            return $sentencia->rowCount();
        }

        public function usuarioHaValoradoEmpresa($id_empresa, $id_usuario){
            $sentencia = $this->db->prepare("SELECT COUNT(*) AS count FROM valoracion WHERE id_empresa = ? AND id_usuario = ?");
            $sentencia->execute(array($id_empresa, $id_usuario));
            $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
            return $resultado->count > 0;
        }

        public function usuarioHaRealizadoPedidoEnEmpresa($id_empresa, $id_usuario){
            $sentencia = $this->db->prepare("SELECT COUNT(*) AS count FROM pedido WHERE id_empresa = ? AND id_usuario = ?");
            $sentencia->execute(array($id_empresa, $id_usuario));
            $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
            return $resultado->count > 0;
        }

        public function deleteValoracion($id_valoracion){
            $sentencia = $this->db->prepare('DELETE FROM valoracion WHERE id=?');
            $sentencia->execute(array($id_valoracion));
        }

        public function marcarEmpresasComoPremium($insertedValue){
            $sentencia = $this->db->prepare("SELECT id_empresa, AVG(valoracion) AS valoracion_promedio FROM valoracion GROUP BY id_empresa HAVING valoracion_promedio >= ?");
            $sentencia->execute(array($insertedValue));
            $empresasPremium = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
            foreach ($empresasPremium as $empresa) {
                $this->marcarEmpresaComoPremium($empresa->id_empresa);
            }
        }
        
        private function marcarEmpresaComoPremium($id_empresa){
            $sentencia = $this->db->prepare("UPDATE empresa SET premium = 1 WHERE id = ?");
            $sentencia->execute(array($id_empresa));
        }
    }

    