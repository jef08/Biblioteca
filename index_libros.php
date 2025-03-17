<!DOCTYPE html>
<head>
    <meta charset = "utf-8">
    <title>Libros</title>
    <link rel = "stylesheet" href = "./styles.css?v=1.0">
</head>
<a href="index.php"><button class = "home">Home</button></a>
<?php

require_once("clases/manager.php");

$manager = new BookManager();

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $index = (int)($_POST['index']);
    $manager->deleteLibros($index);
    echo "<p>Libro eliminado correctamente";
}

//pagination//
$libros = $manager -> getLibros();

$libroLimit = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $libroLimit;
$shownLibros = array_slice($libros, $offset, $libroLimit);
$totalLibros = count($libros);
$totalPaginas = ceil($totalLibros/$libroLimit);

echo "<br><h2>Listado de Libros</h2>";
if (count($shownLibros) == 0) {
    echo '<p>No hay libros registrados</p>';
} else {
    echo '<div id="book-container">';
    foreach ($shownLibros as $index => $libro) {
        echo '<div class="libros">';
        echo "<strong>Título</strong>: " . $libro->getTitulo() . "<br><strong>Autor</strong>: " . $libro->getAutor() . "<br><strong>Año</strong>: " . $libro->getAnyo() . "<br><strong>Páginas</strong>: " . $libro->getPaginas();
        echo '<form method="POST" class="delete-form">';
        echo '<input type="hidden" name="action" value="delete">';
        echo '<input type="hidden" name="index" value="' . $index . '">';
        echo '<button type="submit" class="eliminar">Eliminar</button>';
        echo '</form>';
        echo '</div>';
    }
    echo '</div>';
}

//pagination//
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