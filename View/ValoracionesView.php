<?php

class ValoracionesView
{
    function __construct()
    {
    }

    function showValoraciones($valoraciones, $usuarios, $empresas)
    {
        echo "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lista de Valoraciones</title>
            <link rel='stylesheet' href='Styles/Style.css'>
        </head>
        
        <body>
        
            <div class='container'>
            <div>
            <form action='insertValoracion' method='POST'>
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
                <input name='input_valoracion' type='number' min='1' max='5' placeholder='Valoración (1-5)'>
                <input name='input_resena' type='text' placeholder='Reseña'>
                <div>
                <label for='input_inadecuada'>Inadecuada</label>
                <select name='input_inadecuada'>
                <option value='true'>True</option>
                <option value='false'>False</option>
            </select>
                </div>

                
            
                <button type='submit'>Crear Valoración</button>
            </form>
        </div>
        
        <div>
            <table>
                <thead>
                    <tr>";

        foreach ($valoraciones[0] as $campo => $valor) {
            echo "<th>" . ucfirst($campo) . "</th>";
        }

        echo "</tr>
                </thead>
                <tbody>";

        foreach ($valoraciones as $valoracion) {
            echo "<tr>
                    <td>{$valoracion->id}</td>
                    <td>{$valoracion->nombre_usuario}</td>
                    <td>{$valoracion->nombre_empresa}</td>
                    <td>{$valoracion->valoracion}</td>
                    <td>{$valoracion->resena}</td>
                    <td>" . ($valoracion->inadecuada ? 'Si' : 'No') . "</td>
                    <td><button type='button'><a href='showEditValoracion/{$valoracion->id}'>Editar</a></button></td>
                    <td><button type='button'><a href='deleteValoracion/{$valoracion->id}'>Borrar</a></button></td>
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
