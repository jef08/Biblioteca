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

echo "<br><h2>Listado de Revistas</h2>";
            echo '<div class = "revistas">';
            if (count($manager->getRevistas()) == 0) {
                echo "<p> No hay revistas registrados</p>";
            } else {
                echo "<ul>";
                foreach ($manager -> getRevistas() as $index => $revista) {
                    echo "<li>";
                    echo "<strong>Título</strong>: " . $revista -> getTitulo() . "<br><strong>Autor:</strong> " . $revista-> getAutor() . "<br><strong> Año</strong>: " . $revista -> getAnyo() . "<br><strong>Tipo</strong>: " . $revista -> getTematica();
                    echo '<form method = "POST" class = "delete-form">';
                    echo '<input type = "hidden" name = "action" value = "delete">';
                    echo '<input type = "hidden" name = "index" value="' . $index . '">';
                    echo '<input type = "hidden" name = "var" value = "' . $revista -> getTematica() . '">';
                    echo '<button type = "submit" class = "eliminar">Eliminar</button>';
                    echo '</form>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
?>

</html>