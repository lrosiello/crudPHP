<?php

    Class ValoracionesInadecuadas{

        function __construct()
        {
        }
        

        public function showUsuariosInadecuadas($usuarios, $valoraciones){
            echo "<!DOCTYPE html>
            <html lang='en'>
            
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Auditoría de Reseñas Inadecuadas</title>
                <link rel='stylesheet' href='Styles/Style.css'>
            </head>
            
            <body>
            
                <div class='container'>
                    <h1>Auditoría de Reseñas Inadecuadas</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Total Reseñas</th>
                                <th>Reseñas Inadecuadas</th>
                                <th>Reseñas Inadecuadas Detalles</th>
                            </tr>
                        </thead>
                        <tbody>";
        
                        foreach ($usuarios as $usuario) {
                            echo "<tr>
                                    <td>{$usuario->nombre_usuario}</td>
                                    <td>{$usuario->total_resenas}</td>
                                    <td>{$usuario->total_inadecuadas}</td>
                                    <td>";
                        
                            foreach ($valoraciones as $valoracion) {
                                if (isset($valoracion->id_usuario) && $valoracion->id_usuario == $usuario->usuario_id) {
                                    echo "{$valoracion->nombre_empresa}: {$valoracion->valoracion}/5 - {$valoracion->resena}<br>";
                                }
                            }
                        
                            echo "</td></tr>";
                        }
                        
                        
        
            echo "</tbody>
                    </table>
                </div>
            
            </body>
            
            </html>";
        }
        
    }