<?php

class PedidosView
{

    function __construct()
    {
    }

    function showPedidos($pedidos, $usuarios, $empresas)
    {

        echo "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lista de Pedidos</title>
            <link rel='stylesheet' href='Styles/Style.css'>
        </head>
        
        <body>
        
            <div class='container'>
            <div>
            <form action='insertPedido' method='POST'>
              
                <select name='input_id_usuario'>";
        foreach ($usuarios as $usuario) {
            echo "<option value='{$usuario->id}'>{$usuario->nombre}</option>";
        }
        echo "</select>
                <select name='input_id_empresa'>";
        foreach ($empresas as $empresa) {
            echo "<option value='{$empresa->id}'>{$empresa->nombre}</option>";
        }
        echo "</select>
                <input name='input_pedido' type='text' placeholder='Pedido'>
                <input name='input_fecha' type='text' placeholder='Fecha'>
                <button type='submit'>Crear Pedido</button>
            </form>
        </div>
        
                <div>
                    <table>
                        <thead>
                            <tr>";

        foreach ($pedidos[0] as $campo => $valor) {
            echo "<th>" . ucfirst($campo) . "</th>";
        }

        echo "</tr>
                        </thead>
                        <tbody>";

                        foreach ($pedidos as $pedido) {
                            echo "<tr>
                                        <td>{$pedido->id}</td>
                                        <td>{$pedido->nombre_usuario}</td>
                                        <td>{$pedido->nombre_empresa}</td>
                                        <td>{$pedido->pedido}</td>
                                        <td>{$pedido->fecha}</td>
                                        <td><button type='button'><a href='showEditPedido/{$pedido->id}'>Editar</a></button></td>
                                        <td><button type='button'><a href='deletePedido/{$pedido->id}'>Borrar</a></button></td>
                                    </tr>";
                        }
                        

        echo "</tbody>
                    </table>
                </div>
               
            </div>
            <div>
            <a href='index.php'>Volver a home</a>
    </div>
        </body>
        
        </html>";
    }
}
