<?php

class UsuariosView
{

    function __construct()
    {
    }

    function showUsuarios($usuarios)
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
                    <form action='insertUsuario' method='POST'>
                       
                        <input name='input_nombre' type='text' placeholder='Nombre'>
                        <input name='input_email' type='text' placeholder='Email'>
                        <input name='input_password' type='text' placeholder='Password'>
                        <button type='submit'>Crear</button>
                    </form>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>";

        foreach ($usuarios[0] as $campo => $valor) {
            echo "<th>" . ucfirst($campo) . "</th>";
        }

        echo "</tr>
                        </thead>
                        <tbody>";

        foreach ($usuarios as $usuario) {
            echo "<tr>
                        <td>" . $usuario->id . "</td>
                        <td>" . $usuario->nombre . "</td>
                        <td>" . $usuario->email . "</td>
                        <td>" . $usuario->password . "</td>
                        <td> <button type='button'><a href='showEditUsuario/" .  $usuario->id  . "'>Editar</a></button></td>
                        <td> <button type='button'><a href='deleteUsuario/" . $usuario->id  . "'>Borrar</a></button></td>
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
