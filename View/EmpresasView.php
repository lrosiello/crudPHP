<?php

class EmpresasView
{

    function __construct()
    {
    }

    function showEmpresas($empresas)
    {

        echo "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Document</title>
            <link rel='stylesheet' href='Styles/Style.css'>
        </head>
        
        <body>
        
        
            <div class='container'>
                <div>
                    <form action='insertEmpresa' method='POST'>
                        <button type='submit'>Crear</button>
                        <input name='input_nombre' type='text' placeholder='Nombre'>
                        <input name='input_direccion' type='text' placeholder='Dirección'>
                        <select name='input_premium'>
                            <option value='true'>True</option>
                            <option value='false'>False</option>
                        </select>
                    </form>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>";

        foreach ($empresas[0] as $campo => $valor) {
            echo "<th>" . ucfirst($campo) . "</th>";
        }

        echo "</tr>
                        </thead>
                        <tbody>";

        foreach ($empresas as $empresa) {
            echo "<tr>
                        <td>" . $empresa->id . "</td>
                        <td>" . $empresa->nombre . "</td>
                        <td>" . $empresa->direccion . "</td>
                        <td>" . ($empresa->premium ? 'Si' : 'No') . "</td>
                        <td> <button type='button'><a href='showEditEmpresa/" .  $empresa->id  . "'>Editar</a></button></td>
                        <td> <button type='button'><a href='deleteEmpresa/" . $empresa->id  . "'>Borrar</a></button></td>
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
