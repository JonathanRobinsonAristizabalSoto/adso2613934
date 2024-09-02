<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01- Introduction</title>
    <link rel="stylesheet" href="../css/master.css">
    <style>
        section {
            background-color: #0009;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 10px;
        }

        section h2 {
            margin: 0;
        }

        section form {
            border: 2px solid #fff6;
            background-color: #fff3;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            padding: 10px;
            width: 300px;
        }

        section form label {
            display: flex;
            justify-content: space-between;
            gap: 1.4rem;
        }

        section form output {
            font-size: 1.4rem;
        }

        section form button {
            background-color: #994bde;
            border: 2px solid #fff6;
            border-radius: 8px;
            color: #fff9;
            cursor: pointer;
            font-size: 1rem;
            width: 300px;
            padding: 1rem;
        }

        section form div.result {
            background-color: #0f09;
            border-radius: 8px;
            color: #fffc;
            margin-top: 1rem;
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px;
            width: 280px;
        }
    </style>
</head>
<body>
    <nav class="controls">
        <a href="../index.html">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>    
        </a>
    </nav>
    <main>
        <h1>01- Introduction</h1>
        <section>
            <?php
            class Adition {
                public $num1;
                public $num2;

                public function getResult() {
                    return ($this->num1 + $this->num2);
                }
            }

            if ($_POST) {
                $sum = new Adition;
                $sum->num1 = $_POST['n1'];
                $sum->num2 = $_POST['n2'];
                echo "<div class='result'>The sum of {$sum->num1} and {$sum->num2} = " . 
                     $sum->getResult() . "</div>";
            }
            ?>
            <form action="" method="post">
                <label>
                    <p>Number 1:</p>
                    <input type="range" name="n1" step="1" value="0" oninput="o1.value=this.value">
                    <output id="o1">0</output>
                </label>
                <label>
                    <p>Number 2:</p>
                    <input type="range" name="n2" step="1" value="0" oninput="o2.value=this.value">
                    <output id="o2">0</output>
                </label>
                <button> Calculate </button>
            </form>
        </section>
    </main>
</body>
</html>
