<?php

class UsuarioEditView
{

    function __construct()
    {
    }

    function showEditUsuario($usuario)
    {

        echo "<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Document</title>
            <link rel='stylesheet' href='Styles/Style.css'>
        </head>
        
        <body>";

        echo "<div class='container'>
                <div>
                <form action='http://localhost/repaso/editUsuario/" . $usuario->id . "' method='POST'>
                    <button type='submit'>Editar</button>
                    <input name='input_nombre' type='text' value='" . $usuario->nombre . "'>
                    <input name='input_email' type='text' value='" . $usuario->email . "'>
                    <input name='input_password' type='text' value='" . $usuario->password . "'>
                </form>
                </div>
            </div>
        </body>
        
        </html>";
    }
}
