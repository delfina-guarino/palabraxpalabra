<?php

function es_palabra_valida($palabra) {
    // Puedes usar un array de palabras válidas o un diccionario para verificar si la palabra es válida
    $palabras_validas = array("ejemplo", "palabra", "valida", "otra");
    return in_array($palabra, $palabras_validas);
}

function palabras_posibles($letras) {
    $palabras = array();

    for ($r = 1; $r <= strlen($letras); $r++) {
        $permutaciones = permute($letras, $r);
        foreach ($permutaciones as $perm) {
            $palabra = join('', $perm);
            if (es_palabra_valida($palabra)) {
                $palabras[] = $palabra;
            }
        }
    }

    return array_unique($palabras);
}

function permute($letters, $length) {
    if ($length == 1) {
        return str_split($letters);
    }

    $perms = array();
    $next = permute($letters, $length - 1);

    foreach ($letters as $l) {
        foreach ($next as $n) {
            $perms[] = $l . $n;
        }
    }

    return $perms;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad_letras = $_POST["letras"];
    $palabras_disponibles = palabras_posibles($cantidad_letras);

    if (count($palabras_disponibles) === 0) {
        echo "No se encontraron palabras posibles con las letras dadas.";
    } else {
        echo "Palabras posibles:<br>";
        foreach ($palabras_disponibles as $palabra) {
            echo $palabra . "<br>";
        }
    }
}
?>
