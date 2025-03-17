<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Revistas</title>
    <link rel = "stylesheet" href = "./styles.css?v=1.0">
</head>
<a href="index.php"><button class = "home">Home</button></a>
<?php

require_once("clases/manager.php");

$manager = new BookManager();

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $index = (int)($_POST['index']);
    $manager->deleteRevista($index);
    echo "<p>Revista eliminado correctamente";
};

//pagination//
$revistas = $manager -> getRevistas();

$revistaLimit = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $revistaLimit;
$shownRevistas = array_slice($revistas, $offset, $revistaLimit);
$totalRevistas = count($revistas);
$totalPaginas = ceil($totalRevistas/$revistaLimit);

echo "<br><h2>Listado de Revistas</h2>";
            
if (count($shownRevistas) == 0) {
    echo '<p>No hay revistas registrados</p>';
} else {
    echo '<div id="revista-container">';
    foreach ($shownRevistas as $index => $revista) {
        echo '<div class="revistas">';
        echo "<strong>Título</strong>: " . $revista->getTitulo() . "<br><strong>Autor</strong>: " . $revista->getAutor() . "<br><strong>Año</strong>: " . $revista->getAnyo() . "<br><strong>Páginas</strong>: " . $revista->getTematica();
        echo '<form method="POST" class="delete-form">';
        echo '<input type="hidden" name="action" value="delete">';
        echo '<input type="hidden" name="index" value="' . $index . '">';
        echo '<button type="submit" class="eliminar">Eliminar</button>';
        echo '</form>';
        echo '</div>';
    }
    echo '</div>';
}

echo '<div id = "pagination">';
if ($currentPage > 1) {
    echo '<a href="?page=' . ($currentPage - 1) . '" class = "page-symbol">&laquo;</a>';
}

for ($i = 1; $i <= $totalPaginas; $i++) {
    if ($i == $currentPage) {
        echo '<a href="?page=' . $i . '" class="page-number active">' . $i . '</a>';
    } else {
        echo '<a href="?page=' . $i . '" class="page-number">' . $i . '</a>';
    }
}


if ($currentPage < $totalPaginas) {
    echo '<a href="?page=' . ($currentPage + 1) . '" class = "page-symbol">&raquo;</a>';
}
echo '</div>';
?>

</html>