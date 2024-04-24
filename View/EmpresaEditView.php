<?php

class EmpresaEditView
{

    function __construct()
    {
    }

    function showError($message){
        echo $message;
    }
    function showEditEmpresa($empresa)
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
                <form action='http://localhost/repaso/editEmpresa/" . $empresa->id . "' method='POST'>
                    <button type='submit'>Editar</button>
                    <input name='input_nombre' type='text' value='" . $empresa->nombre . "'>
                    <input name='input_direccion' type='text' value='" . $empresa->direccion . "'>
                    <select name='input_premium'>
                        <option value='true' " . ($empresa->premium ? 'selected' : '') . ">True</option>
                        <option value='false' " . (!$empresa->premium ? 'selected' : '') . ">False</option>
                    </select>
                </form>
                </div>
            </div>
        </body>
        
        </html>";
    }
}
