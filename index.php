<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/Style.css">
    <script src="Libs/Actions.js" defer></script>
</head>

<body>

    <?php
    $url = 'http://localhost/repaso/clases';
    $response = file_get_contents($url);

    if ($response === false) {
        die('Error al obtener datos desde la URL');
    }
    $clases = json_decode($response, true);
    ?>

    <div class="container">
        <div>
            <form action="insertClase" method="POST">
                <button type="submit">Crear</button>
                <input name="input_nombre" type="text" placeholder="Nombre">
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <?php foreach ($clases[0] as $campo => $valor) : ?>
                            <th><?php echo ucfirst($campo); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clases as $clase) : ?>
                        <tr>
                            <td><?php echo $clase['id']; ?></td>
                            <td><?php echo $clase['nombre']; ?></td>
                            <td> <button type="button"><a href="edit.php?id=<?php echo $clase['id']; ?>">Editar</a></button></td>
                            <td> <button type="button"><a href="deleteClase/<?php echo $clase['id']; ?>">Borrar</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>