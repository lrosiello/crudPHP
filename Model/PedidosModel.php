<?php

class PedidosModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=teneloya;charset=utf8', 'root', '');
    }

    
    public function getPedidos()
    {
        $sentencia = $this->db->prepare('SELECT * FROM pedido');
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPedidoById($id_pedido)
    {
        $sentencia = $this->db->prepare('SELECT * FROM pedido WHERE id=?');
        $sentencia->execute(array($id_pedido));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function insertPedido($id_usuario, $id_empresa, $pedido, $fecha)
    {
        $sentencia = $this->db->prepare('INSERT INTO pedido(id_usuario, id_empresa, pedido, fecha) VALUES(?,?,?,?)');
        $sentencia->execute(array($id_usuario, $id_empresa, $pedido, $fecha));
        return $sentencia->rowCount();
    }

    public function editPedido($id_pedido, $id_usuario, $id_empresa, $pedido, $fecha)
    {
        $sentencia = $this->db->prepare('UPDATE pedido SET id_usuario=?, id_empresa=?, pedido=?, fecha=? WHERE id=?');
        $sentencia->execute(array($id_usuario, $id_empresa, $pedido, $fecha, $id_pedido));
    }

    public function deletePedido($id_pedido)
    {
        $sentencia = $this->db->prepare('DELETE FROM pedido WHERE id=?');
        $sentencia->execute(array($id_pedido));
    }

    public function checkUserExists($id_usuario)
    {
        $sentencia = $this->db->prepare('SELECT * FROM usuario WHERE id=?');
        $sentencia->execute(array($id_usuario));
        return $sentencia->fetch(PDO::FETCH_OBJ) !== false;
    }

    public function checkEmpresaExists($id_empresa)
    {
        $sentencia = $this->db->prepare('SELECT * FROM empresa WHERE id=?');
        $sentencia->execute(array($id_empresa));
        return $sentencia->fetch(PDO::FETCH_OBJ) !== false;
    }
}
