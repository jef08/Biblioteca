<html>
    <body>
        <?php

        require_once("./clases/libro.php");
        require_once("./clases/revistas.php");

        class BookManager {
            private array $libros = [];
            private array $revistas = [];
            private string $librosFilePath = 'data_libros.json';

            //construct initializes the objects when we call a new BookManager in index//
            //loading the libros and revistas sets up books and revistas that were previously added//
            public function __construct() {
                $this -> loadPublication();
            }

            //convert book from JSON//
            private function loadPublication() {
                $data = [];
                if (file_exists($this -> librosFilePath)) {
                    $data = json_decode(file_get_contents($this->librosFilePath), true);
                }
                if ($data != null && is_array($data)) {
                    if(isset($data['libros']) && is_array($data['libros'])) {
                       foreach ($data['libros'] as $array) {
                        $this -> libros[] = Libro::fromArray($array);                             
                    }
                }

                    if(isset($data['revistas']) && is_array($data['revistas'])) {
                        foreach ($data['revistas'] as $array) {
                            $this -> revistas[] = Revistas::fromArray($array);                            
                        }
                    }
                }
            }

            private function savePublications() {
                $jsonData = [
                    'libros' => [],
                    'revistas' => []
                ];

                foreach($this -> libros as $object) {
                    $jsonData['libros'][] = $object->toArray();
                }

                foreach ($this->revistas as $object) {
                    $jsonData['revistas'][] = $object -> toArray();
                }
                file_put_contents($this->librosFilePath, json_encode($jsonData, JSON_PRETTY_PRINT));
            }

            public function addPublication(string $titulo, string $autor, int $anyo, $var) {
                if(is_numeric($var)){
                    $libro = new Libro($titulo, $autor, $anyo, $var);
                    $this -> libros[] = $libro;
                } else {
                    $revista = new Revistas($titulo, $autor, $anyo, $var);
                    $this -> revistas[] = $revista;
                }
                $this -> savePublications();
            }

            public function printPublication(){
                foreach($this -> libros as $object) {
                    $object -> print();
                }
                foreach($this -> revistas as $object) {
                    $object -> print();
                }
            }
            
            //Eliminar libro//
            public function deleteLibros(int $index) {
                if(isset($this -> libros[$index])) {
                    unset($this-> libros[$index]);
                    $this -> libros = array_values($this -> libros);
                    $this -> savePublications();
                }
            }

            //Eliminar revista//
            public function deleteRevista(int $index) {
                if(isset($this -> revistas[$index])) {
                    unset($this-> revistas[$index]);
                    $this -> revistas = array_values($this -> revistas);
                    $this -> savePublications();
                }
            }


            

            //Registro de libro//
            public function readLibros(): array {
                return $this-> libros;
            }

            //Registro de revista//
            public function readRevistas(){
                return $this -> revistas;
            }

            //Actualizar libro//
            public function updateBook(int $index, string $newTitle, string $newAuthor, int $newYear, int $newPaginas) {
                if (!isset($this -> libros[$index])) {
                    echo "<br>Libro no encontrado.<br>";
                    return;
                }

                $libro = $this -> libros[$index];
                $libro -> setTitulo($newTitle);
                $libro -> setAutor($newAuthor);
                $libro -> setAnyo($newYear);
                $libro -> setPaginas($newPaginas);

                $this->savePublications();

                echo "<br>Libro actualizado correctamente. <br>";
            }

            //Acualizar Revista//
            public function updateRevista(int $index, string $newTitle, string $newAuthor, int $newYear, string $newTematica) {
                if (!isset($this -> revistas[$index])) {
                    echo "<br>Revista no encontrada.<br>";
                    return;
                }

                $revista = $this -> revistas[$index];
                $revista -> setTitulo($newTitle);
                $revista -> setAutor($newAuthor);
                $revista -> setAnyo($newYear);
                $revista -> setTematica($newTematica);

                $this -> savePublications();

                echo "<br>Revista actualizada correctamente. <br>";
            }

            
            //these getters are necessary because the arrays are private//
            public function getLibros() {
                return $this ->libros;
            }

            public function getRevistas() {
                return $this -> revistas;
            }
        }



        ?>
    </body>
</html>