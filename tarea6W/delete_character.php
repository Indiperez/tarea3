<?php
// Cargar los personajes desde el archivo JSON
$personajes = json_decode(file_get_contents('personajes.json'), true);

$id = $_GET['id'];

// Eliminar el personaje con el ID correspondiente
$personajes = array_filter($personajes, function($personaje) use ($id) {
    return $personaje['id'] != $id;
});

// Reindexar el array
$personajes = array_values($personajes);

// Guardar la lista actualizada en el archivo JSON
file_put_contents('personajes.json', json_encode($personajes, JSON_PRETTY_PRINT));

header('Location: index.php');
?>
