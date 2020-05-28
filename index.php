<?php

require_once "./Contato.php";

echo "<h1>CrudOO</h1>";
echo "<hr>";
$contato = new Contato();
$contato->read();