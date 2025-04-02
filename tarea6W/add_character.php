<?php
// Cargar los personajes desde el archivo JSON
$personajes = json_decode(file_get_contents('personajes.json'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['name'];
    $color = $_POST['color'];
    $tipo = $_POST['type'];
    $nivel = $_POST['level'];
    $foto = $_FILES['photo']['name'];
    $foto_tmp = $_FILES['photo']['tmp_name'];
    $foto_path = "images/" . $foto;

    // Subir la foto
    move_uploaded_file($foto_tmp, $foto_path);

    // Crear un nuevo personaje
    $nuevo_personaje = [
        "id" => count($personajes) + 1,
        "nombre" => $nombre,
        "color" => $color,
        "tipo" => $tipo,
        "nivel" => $nivel,
        "foto" => $foto
    ];

    // Agregarlo a la lista de personajes
    $personajes[] = $nuevo_personaje;

    // Guardar la lista actualizada en el archivo JSON
    file_put_contents('personajes.json', json_encode($personajes, JSON_PRETTY_PRINT));

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Personajes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-container">
        <h2>Agregar Personaje</h2>
        <form method="POST" enctype="multipart/form-data" class="formulario">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="color">Color Representativo</label>
                <input type="text" name="color" id="color" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" id="type" required>
            </div>
            <div class="form-group">
                <label for="level">Nivel</label>
                <input type="number" name="level" id="level" required>
            </div>
            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" name="photo" id="photo" accept="image/*" required>
            </div>
            <button type="submit" class="btn">Agregar Personaje</button>
            <a href="index.php"><button type="button" class="cancel-btn">Cancelar</button></a>
        </form>
    </div>
</body>
</html>
