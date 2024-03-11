<?php

class PedidoEditView
{

    function __construct()
    {
    }

    function showEditPedido($pedido, $usuarios, $empresas)
    {

        echo "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Editar Pedido</title>
            <link rel='stylesheet' href='Styles/Style.css'>
        </head>
        
        <body>";

        echo "<div class='container'>
                <div>
                <form action='http://localhost/repaso/editPedido/" . $pedido->id . "' method='POST'>
                    <button type='submit'>Editar</button>
                    <select name='input_id_usuario'>";
        foreach ($usuarios as $usuario) {
            $selected = ($usuario->id == $pedido->id_usuario) ? "selected" : "";
            echo "<option value='{$usuario->id}' $selected>{$usuario->nombre}</option>";
        }
        echo "</select>
                    <select name='input_id_empresa'>";
        foreach ($empresas as $empresa) {
            $selected = ($empresa->id == $pedido->id_empresa) ? "selected" : "";
            echo "<option value='{$empresa->id}' $selected>{$empresa->nombre}</option>";
        }
        echo "</select>
                    <input name='input_pedido' type='text' value='" . $pedido->pedido . "'>
                    <input name='input_fecha' type='text' value='" . $pedido->fecha . "'>
                </form>
                </div>
            </div>
        </body>
        
        </html>";
    }
}
