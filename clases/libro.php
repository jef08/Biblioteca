<html>
    <body>
        <?php

        require_once("./clases/publicacion.php");

        class Libro extends Publicacion {

            public $paginas;

            function __construct($titulo, $autor, $anyo, $paginas) {
                parent::__construct($titulo, $autor, $anyo);
                $this -> paginas = $paginas;
            }

            function setPaginas($paginas) {
                $this -> paginas = $paginas;
            }

            function getPaginas() {
               return $this -> paginas;
            }

            function describe() {
                parent::describe();
                echo "<br>Paginas: " . $this -> paginas;
            }

            public function toArray():array {
                return [
                    'titulo' => $this -> titulo,
                    'autor' => $this -> autor,
                    'anyo' => $this -> anyo,
                    'paginas' => $this -> paginas
                ];
            }

            public static function fromArray($data):Libro {
                return new Libro ($data['titulo'], $data['autor'], $data['anyo'], $data['paginas']);
            }

            public function print() {
                parent::print();
                echo "Páginas: " . $this ->paginas . "<br>";
            }
        }

        ?>
    </body>
</html>