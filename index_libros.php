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

echo "<br><h2>Listado de Libros</h2>";
echo '<div class = "libros">';
        if (count($manager->getLibros()) == 0) {
            echo '<p>No hay libros registrados</p>';
        } else {
            echo "<ul>";
            foreach ($manager -> getLibros() as $index => $libro) {
                echo "<li>";
                echo "<strong>Título</strong>: " . $libro -> getTitulo() . "<br><strong>Autor</strong>: " . $libro-> getAutor() . "<br><strong>Año</strong>: " . $libro -> getAnyo() . "<br><strong>Páginas</strong>: " . $libro -> getPaginas();
                echo '<form method = "POST" class = "delete-form">';
                echo '<input type = "hidden" name = "action" value = "delete">';
                echo '<input type = "hidden" name = "index" value="' . $index . '">';
                echo '<input type = "hidden" name = "var" value = "' . $libro -> getPaginas() . '">';
                echo '<button type = "submit" class = "eliminar">Eliminar</button>';
                echo '</form>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
?>

</html>