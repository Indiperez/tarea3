<?php
require_once 'libs/tcpdf/tcpdf.php';

// Obtener el ID del personaje
$id = $_GET['id'];

// Cargar los personajes desde el archivo JSON
$personajes = json_decode(file_get_contents('personajes.json'), true);

// Buscar el personaje correspondiente
$personaje = null;
foreach ($personajes as $p) {
    if ($p['id'] == $id) {
        $personaje = $p;
        break;
    }
}

if ($personaje) {
    // Crear el PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);

    // Agregar la foto del personaje
    $pdf->Image('images/' . $personaje['foto'], 10, 10, 40);
    $pdf->Ln(50); // Salto de línea

    // Agregar la información del personaje al PDF
    $pdf->Cell(0, 10, 'Nombre: ' . $personaje['nombre'], 0, 1);
    $pdf->Cell(0, 10, 'Color: ' . $personaje['color'], 0, 1);
    $pdf->Cell(0, 10, 'Tipo: ' . $personaje['tipo'], 0, 1);
    $pdf->Cell(0, 10, 'Nivel: ' . $personaje['nivel'], 0, 1);

    // Generar y descargar el PDF
    $pdf->Output('D', 'perfil_' . $personaje['nombre'] . '.pdf');
} else {
    echo "Personaje no encontrado.";
}
?>
