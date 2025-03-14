<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Biblioteca</title>
        <link rel = "stylesheet" href = "styles.css?v=1.0"> 
    </head>
    <body>
        <?php

        require_once("./clases/manager.php");

        $manager = new BookManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
             $titulo = $_POST['title'] ?? '';
             $autor = $_POST['author'] ?? '';
             $anyo = (int)$_POST['year'] ?? 0;
            $var = $_POST['var'];

            $manager -> addPublication($titulo, $autor, $anyo, $var);
        }
        ?>

        <h1>Biblioteca</h1>

        <a href = "index_libros.php"><button class = "libro-bttn">Libros</button></a>
        <a href = "index_revistas.php"><button class = "revista-bttn">Revistas</button></a>

        <h2>Añadir un libro o una revista</h2>

        <div class = "form">
            <form method = "post">
                
                <label for = "title">Título:</label>
                <input type = "text" id = "title" name = "title" required>
                <br>
                <label for = "author">Autor:</label>
                <input type = "text" id = "author" name = "author" required>
                <br>
                <label for = "year">Año:</label>
                <input type = "number" id = "year" name = "year" min = "0" required>
                <br>
                <label for = "var">Páginas de libro o tipo de revista:</label>
                <input type = "text" id = "var" name = "var" required>
                <br>
                <button type = "submit" id = "submit">Añadir</button>
            </form>
        </div>
    </body>
</html>