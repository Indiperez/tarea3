<?php
// Cargar los personajes desde el archivo JSON
$personajes = json_decode(file_get_contents('personajes.json'), true);

$id = $_GET['id'];
$personaje = null;

// Buscar el personaje por ID
foreach ($personajes as &$p) {
    if ($p['id'] == $id) {
        $personaje = &$p; // Encontramos el personaje
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $personaje['nombre'] = $_POST['name'];
    $personaje['color'] = $_POST['color'];
    $personaje['tipo'] = $_POST['type'];
    $personaje['nivel'] = $_POST['level'];
    
    // Verificar si se sube una nueva foto
    if ($_FILES['photo']['name']) {
        $foto = $_FILES['photo']['name'];
        $foto_tmp = $_FILES['photo']['tmp_name'];
        $foto_path = "images/" . $foto;
        move_uploaded_file($foto_tmp, $foto_path);
        $personaje['foto'] = $foto;
    }

    // Guardar la lista actualizada en el archivo JSON
    file_put_contents('personajes.json', json_encode($personajes, JSON_PRETTY_PRINT));

    header('Location: index.php');
}
if (!file_exists('images')) {
    mkdir('images', 0777, true);
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Personaje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-container">
        <h2>Actualizar Personaje</h2>
        <form method="POST" enctype="multipart/form-data" class="formulario">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="<?php echo $personaje['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="color">Color Representativo</label>
                <input type="text" name="color" id="color" value="<?php echo $personaje['color']; ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Tipo</label>
                <input type="text" name="type" id="type" value="<?php echo $personaje['tipo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="level">Nivel</label>
                <input type="number" name="level" id="level" value="<?php echo $personaje['nivel']; ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" name="photo" id="photo">
            </div>
            <button type="submit" class="btn">Actualizar Personaje</button>
            <a href="index.php"><button type="button" class="cancel-btn">Cancelar</button></a>
        </form>
    </div>
</body>
</html>
