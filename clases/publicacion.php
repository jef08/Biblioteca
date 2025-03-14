<html>
    <body>
        <?php

        class Publicacion {

            public $titulo;
            public $autor;
            public $anyo;

            function __construct($titulo, $autor, $anyo) {
                $this -> titulo = $titulo;
                $this -> autor = $autor;
                $this -> anyo = $anyo;
            }

            function getTitulo() {
                return $this -> titulo;
            }

            function setTitulo($titulo) {
                $this -> titulo = $titulo;
            }

            function setAutor($autor) {
                $this -> autor = $autor;
            }

            function getAutor() {
                return $this -> autor;
            }

            function setAnyo($anyo) {
                $this -> anyo = $anyo;
            }

            function getAnyo() {
                return $this -> anyo;
            }

            function describe() {
                echo "<br>Titulo: " . $this -> titulo;
                echo "<br>Autor: " . $this -> autor;
                echo "<br>Año: " . $this -> anyo;
            }

            public function print(){
                echo "Título: " . $this -> titulo . " Autor: " . $this -> autor . " Año: " . $this -> anyo;
            }
        }

        ?>
    </body>
</html>