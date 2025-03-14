<html>
    <body>
        <?php

        require_once("./clases/libro.php");

        class Revistas extends Publicacion {

            public $tematica;

            function __construct($titulo, $autor, $anyo, $tematica) {
                parent::__construct($titulo, $autor, $anyo);
                $this -> tematica = $tematica;
            }

            function setTematica($tematica) {
                $this -> tematica = $tematica;
            }

            function getTematica() {
                return $this -> tematica;
            }

            function describe() {
                parent::describe();
                echo "<br>tematica: " . $this -> tematica;
            }

            public function toArray():array {
                return [
                    'titulo' => $this -> titulo,
                    'autor' => $this -> autor,
                    'anyo' => $this -> anyo,
                    'tematica' => $this -> tematica,
                ];
            }

            public static function fromArray($data):Revistas {
                return new Revistas ($data['titulo'], $data['autor'], $data['anyo'], $data['tematica']);
            }

            public function print() {
                parent::print();
                echo "Tipo: " . $this -> tematica . "<br>";
            }
        }

        ?>
    </body>
</html>