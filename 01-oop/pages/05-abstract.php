<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05- Abstract</title>
    <link rel="stylesheet" href="../css/master.css">
    <style>
        table {
            border-collapse: collapse;

            tr:nth-child(even) {
                background-color: #0006;
            }

            tr:nth-child(1) th:first-child {
                border-radius: 10px 0 0 0;
            }

            tr:nth-child(1) th:last-child {
                border-radius: 0 10px 0 0;
            }

            tr:last-child td:first-child {
                border-radius: 0 0 0 10px;
            }

            tr:last-child td:last-child {
                border-radius: 0 0 10px 0;
            }

            th {
                padding: 0.6rem;
                background-color: #fff6;
                color: #0009;
            }

            td {
                background-color: #0009;
                padding: 0.2rem 1rem;

                img {
                    width: 40px;
                }
            }
        }
    </style>
</head>

<body>
    <nav class="controls">
        <a href="../index.html">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#ffffff" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z" />
            </svg>
        </a>
    </nav>
    <main>
        <h1>05- Abstract</h1>
        <section>
            <?php
            abstract class DataBase
            {
                // Attributes
                protected $host;
                protected $user;
                protected $pass;
                protected $dbname;
                protected $conx;

                // Methods
                public function __construct(
                    $dbname,
                    $host = 'localhost',
                    $user = 'root',
                    $pass = ''
                ) {
                    $this->host   = $host;
                    $this->user   = $user;
                    $this->pass   = $pass;
                    $this->dbname = $dbname;
                }

                public function connect()
                {
                    try {
                        $this->conx = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                        // if($this->conx) {
                        //     echo "😜";
                        // }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }

            class Pokemon extends DataBase
            {
                public function getData()
                {
                    try {
                        $sql = "SELECT * FROM pokemons";
                        $stm = $this->conx->prepare($sql);
                        $stm->execute();
                        return $stm->fetchAll();
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }

            $db = new Pokemon('adso2613934');
            $db->connect();
            $pokemons = $db->getData();
            //echo var_dump($pokemons);
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Health</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pokemons as $pk) : ?>
                        <tr>
                            <td><?= $pk['id'] ?></td>
                            <td><?= $pk['name'] ?></td>
                            <td><?= $pk['type'] ?></td>
                            <td><?= $pk['health'] ?></td>
                            <td><img src="../images/<?= $pk['image'] ?>" alt="<?= $pk['name'] ?>"></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>