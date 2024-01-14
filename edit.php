<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/Style.css">
</head>

<body>

    <<?php
        $claseId = isset($_GET['id']) ? $_GET['id'] : null;
        $url = 'http://localhost/repaso/clases/'.$claseId;
        $response = file_get_contents($url);
        if ($response === false) {
            die('Error al obtener datos desde la URL');
        }
        $clase = json_decode($response, true);
        $urlToEdit = "editClase/".($clase['id']);
    ?>

    <div class="container">
        <div>
            <form action=<?php echo($urlToEdit); ?> method="POST">
                <button type="submit">Editar</button>
                <input name="input_nombre" type="text" placeholder=<?php echo($clase['nombre']); ?>>
            </form>
        </div>
    </div>
</body>

</html>