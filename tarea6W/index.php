<?php
// Verificar si el archivo JSON existe
$file_path = 'personajes.json';
if (file_exists($file_path)) {
    $personajes = json_decode(file_get_contents($file_path), true);
} else {
    $personajes = []; // Si el archivo no existe, inicializa la variable como un arreglo vacío.
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personajes - Demon Slayer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Enlace al archivo CSS -->
</head>
<body>

<div class="container mt-5">
    <h1>Gestión de Personajes - Attack on Titan</h1>
    <a href="add_character.php" class="btn btn-primary mb-3">Agregar Nuevo Personaje</a>

    <!-- Tabla de Personajes -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Tipo</th>
                <th>Nivel</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personajes as $personaje): ?>
                <tr>
                    <td><img src="images/<?php echo $personaje['foto']; ?>" class="personaje-img"></td>
                    <td><?php echo $personaje['nombre']; ?></td>
                    <td><?php echo $personaje['color']; ?></td>
                    <td><?php echo $personaje['tipo']; ?></td>
                    <td><?php echo $personaje['nivel']; ?></td>
                    <td>
                        <!-- Editar personaje -->
                        <a href="edit_character.php?id=<?php echo $personaje['id']; ?>" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Eliminar personaje -->
                        <a href="delete_character.php?id=<?php echo $personaje['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este personaje?')">Eliminar</a>

                        <!-- Descargar PDF -->
                        <a href="download_pdf.php?id=<?php echo $personaje['id']; ?>" class="btn btn-info btn-sm">Descargar PDF</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
